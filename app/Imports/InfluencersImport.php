<?php

namespace App\Imports;

use Modules\Area\Entities\City;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Area\Entities\Country;
use Modules\Influencer\Entities\Tag;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Modules\Influencer\Entities\Influencer;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class InfluencersImport implements ToCollection, WithHeadingRow
{
    use Importable;

    private $notImport = [];


    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        dd($row);
        return new Influencer([
            //
        ]);
    }

    public function collection(Collection $rows)
    {
        $country = Country::first();
        DB::beginTransaction();

        try {
            foreach ($rows as $key=> $row) {
                if (!$row->get("phone")) {
                    // $this->notImport[] = $row->toArray();
                    array_push($this->notImport, $row->toArray());
                    continue;
                }
                $model = $this->createInfluencer($row, $country);
                $this->createInstagram($model, $row);
                $this->addTagsToInfluencers($model, $row["category"]);
            }

            DB::commit();
            echo \json_encode($this->notImport);
        } catch (\Exception $e) {
            // dd($row);
            DB::rollback();
            throw $e;
        }
    }

    public function headingRow(): int
    {
        return 1;
    }

    private function formateMobileNumber($mobile)
    {
        if (is_null($mobile) || (is_string($mobile) && strlen($mobile) == 0)) {
            return null;
        }
        $numberFormat = trim(preg_replace('/(^965|^\+20|^20|^\+965|^00965)/', "", $mobile));
        return  $numberFormat ;
    }

    private function formateContactMobile($mobiles)
    {
        $mobiles = trim($mobiles);
        if (\strlen($mobiles) == 0) {
            return [];
        }
        $mobiles = \explode(",", $mobiles);
        return array_map(function ($mobile) {
            return str_replace(" ", "", $mobile);
        }, $mobiles);
    }


    private function getTag($tag)
    {
        $tag = Tag::updateOrCreate(["title->en"=>$tag], [
            "title" => [
                "ar"=> $tag ,
                "en" => $tag,
            ]
        ]);

        return $tag->id;
    }

    private function getTagsId($category)
    {
        $category  = trim($category);
        if (\strlen($category) == 0) {
            return [];
        }
        $ids = [];
        $category =  preg_replace("/(and|&|\.|\|)/i", ",", $category);
        $tags = \explode(",", $category);
        foreach ($tags as $key => $tag) {
            array_push($ids, $this->getTag($tag));
        }
        return $ids;
    }

    private function addTagsToInfluencers($model, $category)
    {
        if (is_null($category)) {
            return;
        }
        $ids = $this->getTagsId($category);
        if (count($ids) == 0) {
            return ;
        }
        $model->tags()->syncWithoutDetaching($ids);
    }

    private function createInfluencer($row, $country)
    {
        $mobile = $this->formateMobileNumber($row["phone"] ?? "");
        $model = Influencer::updateOrCreate([
            "mobile" => $mobile ,
            "phone_code"=> "965"
        ], [
            "name" => [
                "ar" => $row["name"]?? $row["instagram_username"] ?? null,
                "en" => $row["name"]?? $row["instagram_username"] ?? null
            ],
            "address_desc"=> $row["address"]?? null,
            "mobile" => $mobile ,
            "contacts"   => $this->formateContactMobile($row["phone2"]),
            "country_id" => $country->id
        ]);
        return $model;
    }

    private function createInstagram($model, $row)
    {
        $instagram = $row["instagram_username"] ?? null;
        if (is_null($instagram)) {
            return ;
        }
        $instagram = "https://www.instagram.com/$instagram/";
        $model->instagrams()->updateOrCreate([
            "url" => $instagram
        ], [
            "user_name"=> $row["instagram_username"],
        ]);
    }
}
