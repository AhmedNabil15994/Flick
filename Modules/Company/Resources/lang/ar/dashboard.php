<?php

return [
    "companies"=> [
        'routes'    => [
            'index'     => 'الشركات',
            "create"    => "انشاء شركه ",
            "update"    => " تعديل شركه" ,
            "show"      => "تفاصيل شركه "

        ],
        'datatable' => [
            'name' => 'الاسم',
            'description' => 'الوصف',
            "email"=> "البريد الالكترونى",
            "logo" => "اللوجو",
            "mobile"=> "رقم التواصل",
            "manager_id" => "المدير",
            "workers"  => "العاملين",
            "status"  => "الحاله",
            'created_at' => 'تاريخ إتخاذ الإجراء',
            'options' => 'الخيارات',
        ],
        'form'      => [
            'name' => 'الاسم',
            'description' => 'الوصف',
            "email"=> "البريد الالكترونى",
            "logo" => "اللوجو",
            "mobile"=> "رقم التواصل",
            "manager_id" => "المدير",
            "workers"  => "العاملين",
            "tags"      => "الاهتمامات",
            "status"  => "الحاله",
            'tabs'      => [
                'general'   => 'بيانات عامة',
                "subscriptions" => "الاشتراكات"
            ],
        ],
        "show" => [
            "subscriptions"=> [
              "current"  => "الاشتراك الحالى"  ,
              "package_id"  => "الباقه",
              "start_at" => "تاريخ البدايه",
              "comment"   => "ملاحظات", 
              "number_of_influencers" => "عدد المشاهير",
              "using_count" => "عدد المشاهير المستختدمين",
              "end_at"   => "تاريخ النهايه" ,
              "from_admin"=> "تم الاضافه من قبل الادمن",
              "transtions_id" => "عملية الدفع",
              "price"         => "السعر" ,
              "add"           => "اضافة باقة جديد"
            ],
          ],

    ],
];
