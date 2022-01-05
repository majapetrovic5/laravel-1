<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Patient;
use \App\Models\PatientStatus;
use \App\Models\Report;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         Patient::truncate();
         PatientStatus::truncate();
         User::truncate();

         $user1 = User::create([
            'name'=>"Marko Petrovic",
            'email'=>"petrovicmarko@gmail.com",
            'password' => Hash::make('marko.petrovic123'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role' => 'Admin',

        ]);

         User::factory(5)->create();

        
         Patient::factory(7)->create();
    
         $status1 = PatientStatus::create([
            'status'=>"very bad"
        ]);
        
        $status2 = PatientStatus::create([
            'status'=>"bad"
            
        ]);
        $status3 = PatientStatus::create([
            'status'=>"mostly bad"
            
        ]);
        $status4 = PatientStatus::create([
            'status'=>"mostly good"
            
        ]);
        $status5 = PatientStatus::create([
            'status'=>"good"
            
        ]);

        
        $report1 = Report::create([
            'patientId'=>"1",
            'doctorId'=>"1",
            'datetime'=>now(),
             'report'=>"General: denies fatigue, malaise, fever, weight loss
             Eyes: denies blurring, diplopia, irritation, discharge
             Ear/Nose/Throat: denies ear pain or discharge, nasal obstruction or discharge, sore throat
             Cardiovascular: denies chest pain, palpitations, paroxysmal nocturnal dyspnea, orthopnea, edema Respiratory: denies coughing, wheezing, dyspnea, hemoptysis
             Gastrointestinal: denies abdominal pain, dysphagia, nausea, vomiting, diarrhea, constipation
             Genitourinary: denies hematuria, frequency, urgency, dysuria, discharge, impotence, incontinence
             Musculoskeletal: denies back pain, joint swelling, joint stiffness, joint pain
             Skin: denies rashes, itching, lumps, sores, lesions, color change
             Neurologic: denies syncope, seizures, transient paralysis, weakness, paresthesias
             Psychiatric: denies depression, anxiety, mental disturbance, difficulty sleeping, suicidal ideation, hallucinations, paranoia
             Endocrine: denies polyuria, polydipsia, polyphagia, weight change, heat or cold intolerance
             Heme/Lymphatic: denies easy or excessive bruising, history of blood transfusions, anemia, bleeding disorders, adenopathy, chills, sweats
             Allergic/Immunologic: denies urticaria, hay fever, frequent UTIs; denies HIV high risk behaviors",
            'patientStatus'=>"4"
        ]);
 
        $report1 = Report::create([
            'patientId'=>"2",
            'doctorId'=>"2",
            'datetime'=>now(),
            'report'=>"Mr Tans dementia and stroke have impaired the functioning of his mind and brain.
            His failure to remember where he was (i.e. in the hospital) and the day and date,
            despite being told a short while ago, shows his inability to retain information. He was
            also not able to remember basic information such as his age, and the address where he
            lives.
            His failure to tell the time from a watch or to recognize notes and coins shows his
            inability to understand simple information.
            He could not do basic arithmetic, which shows that he is not able to weigh and use
            information.
            Since he is unable to understand, retain, use or weigh simple information, due to his
            memory deficits and cognitive failures, he will not be able to make decisions about
            his personal and financial affairs, which would require being able to process such
            information. This is also demonstrated by his inability to remember basic information
            on the property he owns with his elderly mother, and also his inability to make a
            realistic and concrete plan for what to do with the property. He was also not able to
            remember what medical problems he has, and not able to answer a question as to
            whether he is currently on medication.
            In my view, his cognitive functions are unlikely to improve and would most likely get
            worse over time, as there is no treatment which can reverse his dementia",
            'patientStatus'=>"3"
        ]);
 


    }
}
