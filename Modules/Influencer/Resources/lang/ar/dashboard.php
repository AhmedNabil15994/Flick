<?php

return [
    'tags' => [
        'routes'    => [
            'index'     => 'العلامات',
            "create"    => " انشاء علامه",
            "update"    => "تعديل علامه" ,
        ],
        'datatable' => [
            'title' => 'العنوان',
            'description' => 'الوصف',
            "status"  => "الحاله",
            'created_at' => 'تاريخ إتخاذ الإجراء',
            'options' => 'الخيارات',
        ],
        'form'      => [
            'title' => 'العنوان',
            'description' => 'الوصف',
            "status"  => "الحاله",
            'tabs'      => [
                'general'   => 'بيانات عامة',
            ],
        ],

    ],
    "influencers"=> [
        'routes'    => [
            'index'     => 'المشاهير',
            "create"    => "انشاء مشهور ",
            "update"    => " تعديل مشهور" ,
            "show"      => "تفاصيل مشهور "

        ],
        'datatable' => [
            'name' => 'الاسم',
            'bio' => 'الوصف',
            "email"=> "البريد الالكترونى",
            "image" => "الصوره",
            "contact_number"=> "رقم التواصل",
            "website_url" => "لينك الموقع" ,
            "country_id" => "البلد",
            "mobile"         => "الجوال",
            "tags"  => "الروابط",
            "instagram"=>"حسابات الانستجرام",
            "youtube"=>"حسابات اليوتيوب",
            "tiktok" => "حسابات التك توك",
            "status"  => "الحاله",

            'created_at' => 'تاريخ إتخاذ الإجراء',
            'options' => 'الخيارات',
            "filters" => [
                "type"   => "النوع",
                'start'  => "من" ,
                "end"    => "الى",
            ]
        ],
        'form'      => [
            'name' => 'الاسم',
            'bio' => 'الوصف',
            "nationality_id"=> "الجنسيه",
            "address_desc" => "وصف العنوان",
            "gender"=> "الجنس",
            "birth_date"=> "تاريخ الميلاد",
            "genders"=>[
                "male"=> "ذكر",
                "female"=> "انثى"
            ],
            "city_id"=> "المحافظه",
            "state_id"=> "المدينه",
            "has_twitter"=> "يملك تويتر",
            "has_tiktok"=> "يملك تيك توك",
            "has_twitch"=> "يملك تويتش ",
            "has_youtube"=> "يملك يوتيوب",
            "has_instagram"=> "يملك انستجرام",
            "email"=> "البريد الالكترونى",
            "image" => "الصوره",
            "contacts" => "وسائل تواصل اخرى",
            "contact_number"=> "رقم التواصل",
            "tags"  => "الروابط",
            "socials"=>"روابط التواصل الاجتماعى",
            "website_url" => "لينك الموقع" ,
            "country_id" => "البلد",
            "status"  => "الحاله",
            'tabs'      => [
                'general'   => 'بيانات عامة',
                "address" => "العنوان",
            ],
        ],

    ],
    "instagram"=> [
        'routes'    => [
            'index'     => 'حسابات الانستجرام',
            "create"    => "انشاء حساب الانستجرام",
            "update"    => " تعديل حساب الانستجرام" ,
            "show"      => "تفاصيل حساب المشهور"

        ],
        'datatable' => [
            'influencer_id' => 'المشهور',
            'user_name' => ' اسم المستخدم ',
            "account_id" => "رقم تعريف الحساب",
            "latest_calling_at"=> "اخر تحديث  الاحصائيات",
            "workers"  => "العاملين",
            "status"  => "الحاله",
            'created_at' => 'تاريخ  الانشاء',
            'options' => 'الخيارات',
        ],
        'form'      => [
            'influencer_id' => 'المشهور',
            'user_name' => ' اسم المستخدم ',
            "account_id" => "رقم تعريف الحساب",
            "latest_calling_at"=> "اخر تحديث  الاحصائيات",
            "url"        => "رابط البروفيل ",
            "followers" => "المتابعين",
            "posts_count" => "المنشورات",
            "avg_likes"  => "متوسط الاعجابات",
            "avg_comments"  => "متوسط التعليقات",
            "avg_views"  => "متوسط المشاهدات",
            "avg_views"  => "متوسط المشاهدات",
            "avg_reels_plays"=> "avg reels plays",
            "posts_with_hidden_likes_percentage"=> "نسبة عدد الليكات المخفيه",
            "workers"  => "العاملين",
            "stat_history" =>"سجل الاحصائيات",
            "audience_genders"=>"جنس الجمهور",
            "audience_ages"   => "اعمار الجمهور",
            "audience_genders_per_age" =>" انواع الجماهير بالنسبه للعمر",
            "engagement_rate"    => "معدل الارتباط",
            "engagements"        => "الارتباط",
            "is_verified"       => "حساب موثق",
            "is_business"       => "حساب عمل",
            "api_info"          => "معلومات الاتصال بالخدمه",
            "is_hidden"         => "حساب مخفى",
            "audience_types"   => "انواع الجمهور" ,
            'quality_score' => 'نقاط الجودة',
            "msg"           => [
                "success" => "تم التحديث بنجاح",
                "failed"  => "بتعذر التحديث يرجى التحقق من رابط المشهور"
            ],
            "status"  => "الحاله",
            'tabs'      => [
                'general'   => 'بيانات عامة',
                "statistic" => "احصائيات",
            ],
        ],

    ],
    "youtube"=> [
        'routes'    => [
            'index'     => 'حسابات اليوتيوب',
            "create"    => "انشاء حساب اليوتيوب",
            "update"    => " تعديل حساب اليوتيوب" ,
            "show"      => "تفاصيل  حساب اليوتيوب"
        ],
        'datatable' => [
            'influencer_id' => 'المشهور',
            'user_name' => ' اسم المستخدم ',
            "account_id" => "رقم تعريف الحساب",
            "latest_calling_at"=> "اخر تحديث  الاحصائيات",
            "workers"  => "العاملين",
            "status"  => "الحاله",
            'created_at' => 'تاريخ  الانشاء',
            'options' => 'الخيارات',
        ],
        'form'      => [
            "avg_dislikes" => "متوسط عدم الاعجاب",
            "total_views"  => "اجمالى المشاهدات",
            "audience_genders_commenter" => "جنس الجمهور فى التعليقات",
            "audience_genders_per_age_commenter" => "جنس الجمهور  بالنسبه للعمر فى التعليقات",
            'influencer_id' => 'المشهور',
            "avg_comments"  => "متوسط التعليقات",
            'user_name' => ' اسم المستخدم ',
            "account_id" => "رقم تعريف الحساب",
            "latest_calling_at"=> "اخر تحديث  الاحصائيات",
            "url"        => "رابط البروفيل ",
            "followers" => "المتابعين",
            "posts_count" => "المنشورات",
            "avg_likes"  => "متوسط الاعجابات",
            "avg_views"  => "متوسط المشاهدات",
            "avg_views"  => "متوسط المشاهدات",
            "workers"  => "العاملين",
            "stat_history" =>"سجل الاحصائيات",
            "audience_genders"=>"جنس الجمهور",
            "audience_ages"   => "اعمار الجمهور",
            "audience_genders_per_age" =>" جنس الجماهير بالنسبه للعمر",
            "engagement_rate"    => "معدل الارتباط",
            "engagements"        => "الارتباط",
            "is_verified"       => "حساب موثق",
            "api_info"          => "معلومات الاتصال بالخدمه",
            "is_hidden"         => "حساب مخفى",
            "audience_types"   => "انواع الجمهور" ,
            "msg"           => [
                "success" => "تم التحديث بنجاح",
                "failed"  => "بتعذر التحديث يرجى التحقق من رابط المشهور"
            ],
            "status"  => "الحاله",
            'tabs'      => [
                'general'   => 'بيانات عامة',
                "statistic" => "احصائيات",
            ],
        ],

    ],
    "tiktok"=> [
        'routes'    => [
            'index'     => 'حسابات التيك توك',
            "create"    => "انشاء حساب التيك توك",
            "update"    => " تعديل حساب التيك توك" ,
            "show"      => "تفاصيل حساب التيك توك"

        ],
        'datatable' => [
            'influencer_id' => 'المشهور',
            'user_name' => ' اسم المستخدم ',
            "account_id" => "رقم تعريف الحساب",
            "latest_calling_at"=> "اخر تحديث  الاحصائيات",
            "workers"  => "العاملين",
            "status"  => "الحاله",
            'created_at' => 'تاريخ  الانشاء',
            'options' => 'الخيارات',
        ],
        'form'      => [
            "audience_reachability" => "احصائية الوصل للجمهور",
            "audience_genders_per_age_commenter" => "جنس الجمهور  بالنسبه للعمر فى التعليقات",
            'influencer_id' => 'المشهور',
            "avg_comments"  => "متوسط التعليقات",
            'user_name' => ' اسم المستخدم ',
            "account_id" => "رقم تعريف الحساب",
            "latest_calling_at"=> "اخر تحديث  الاحصائيات",
            "url"        => "رابط البروفيل ",
            "followers" => "المتابعين",
            "posts_count" => "المنشورات",
            "avg_likes"  => "متوسط الاعجابات",
            "avg_views"  => "متوسط المشاهدات",
            "total_likes"  => "اجمالى الاعجابات",
            "workers"  => "العاملين",
            "stat_history" =>"سجل الاحصائيات",
            "audience_genders"=>"جنس الجمهور",
            "audience_ages"   => "اعمار الجمهور",
            "audience_genders_per_age" =>" جنس الجماهير بالنسبه للعمر",
            "engagement_rate"    => "معدل الارتباط",
            "engagements"        => "الارتباط",
            "is_verified"       => "حساب موثق",
            "api_info"          => "معلومات الاتصال بالخدمه",
            "is_hidden"         => "حساب مخفى",
            "audience_types"   => "انواع الجمهور" ,
            "msg"           => [
                "success" => "تم التحديث بنجاح",
                "failed"  => "بتعذر التحديث يرجى التحقق من رابط المشهور"
            ],
            "status"  => "الحاله",
            'tabs'      => [
                'general'   => 'بيانات عامة',
                "statistic" => "احصائيات",
            ],
        ],

    ],
    "twitch"=> [
        'routes'    => [
            'index'     => 'حسابات تويتش',
            "create"    => "انشاء حساب تويتش",
            "update"    => " تعديل حساب تويتش" ,
            "show"      => "تفاصيل  حساب تويتش"
        ],
        'datatable' => [
            'influencer_id' => 'المشهور',
            'user_name' => ' اسم المستخدم ',
            "account_id" => "رقم تعريف الحساب",
            "latest_calling_at"=> "اخر تحديث  الاحصائيات",
            "workers"  => "العاملين",
            "status"  => "الحاله",
            'created_at' => 'تاريخ  الانشاء',
            'options' => 'الخيارات',
        ],
        'form'      => [
            'influencer_id' => 'المشهور',
            'user_name' => ' اسم المستخدم ',
            "account_id" => "رقم تعريف الحساب",
            "latest_calling_at"=> "اخر تحديث  الاحصائيات",
            "workers"  => "العاملين",
            "status"  => "الحاله",
            'tabs'      => [
                'general'   => 'بيانات عامة',
                "statistic" => "احصائيات",
            ],
        ],

    ],
    'campaigns' => [
        'routes'    => [
            'index'     => 'الحملات',
            "create"    => " انشاء حمله",
            "update"    => "تعديل حمله" ,
            "show"      => "تفاصيل الحمله"
        ],
        'datatable' => [
            'title' => 'العنوان',
            'description' => 'الوصف',
            "company_id"    => "مالك الحمله",
            "is_active" => "نشط",
            "type" => "النوع",
            "status"  => "الحاله",
            "influencers"=> "المشاهير",
            "cover"    => "صورة الحمله",
            'created_at' => 'تاريخ إتخاذ الإجراء',
            "start_at"  => "تاريح البدايه",
            "end_at"  => "تاريح النهايه",
            'options' => 'الخيارات',
        ],
        'form'      => [
            'title' => 'العنوان',
            'description' => 'الوصف',
            "company_id"    => "مالك الحمله",
            "influencers"=> "المشاهير",
            "cover"    => "صورة الحمله",
            "is_active" => "نشط",
            "status"  => "الحاله",
            "influencers"=> "المشاهير",
            'tabs'      => [
                'general'   => 'بيانات عامة',
                "influencers"=> "المشاهير"
            ],
        ],

    ],
    'events' => [
        'routes'    => [
            'index'     => 'مجموعه',
            "create"    => " انشاء مجموعه",
            "update"    => "تعديل مجموعه" ,
            "show"      => "تفاصيل المجموعه"
        ],
        'datatable' => [
            'title' => 'العنوان',
            'description' => 'الوصف',
            "campaign_id"    => "الحمله",
            "mobile"         => "الجوال",
            "status"  => "الحاله",
            "invitations_count"=> "عدد الدعوات",
            "invitations_accept_count"=>  "عدد الدعوات المقبوله" ,
            "invitations_refused_count"=>  "عدد الدعوات المرفوضه" ,
            "influencers_instagram"=> "مشاهير الانستجرام",
            "influencers_youtube"=> "مشاهير اليويتيوب",
            "influencers_tiktok"=> "مشاهير التك توك",
            "invitations"=> "الدعوات",
            'created_at' => 'تاريخ إتخاذ الإجراء',
            "start_at"  => "تاريح البدايه",
            "end_at"  => "تاريح النهايه",
            'options' => 'الخيارات',
            'invitations_statuses' => [
                \Modules\Influencer\Enum\InvitationStatus::WAITING  => 'الإنتظار',
                \Modules\Influencer\Enum\InvitationStatus::ACCEPT  => 'تمت الموافقة',
                \Modules\Influencer\Enum\InvitationStatus::REFUSED  => 'معتزر',
                \Modules\Influencer\Enum\InvitationStatus::ATTENDED  => 'تم الحضور',
            ],
        ],
        'form'      => [
            'video' => 'الفيديو',
            'show_video'    => 'عرض الفيديو',
            'title' => 'العنوان',
            'description' => 'نص الدعوه',
            "mobile"         => "الجوال",
            "campaign_id"    => "الحمله",
            "coverage_message" => "نص التغطيه",
            "location_desc"    => "وصف العنوان",
            "influencers"=> "المشاهير",
            "status"  => "الحاله",
            "influencers"=> "المشاهير",
            'campaign_url' => 'رابط الدعوة',

            "start_at"  => "تاريح البدايه",
            "end_at"  => "تاريح النهايه",
            "location"   => "لينك الموقع",
            "helper_links"=> "روابط مساعده",
            "add_influencers" => "اضافة المشاهير المحددين",
            "companions_count"=> "عدد المرافقين",
            'tabs'      => [
                'general'   => 'بيانات عامة',
                "influencers"=> "المشاهير"
            ],
            'invitation_status' => 'حالة الدعوة',
            'active' => "مفعل",
            'notActive' => 'غير مفعل',
            'update_status' => 'تحديث الحالة',
        ],
        'select_status' => 'من فضلك اختر الحالة',

    ],

];
