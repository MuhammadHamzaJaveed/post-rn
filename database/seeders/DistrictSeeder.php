<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->districts() as $key => $name) {
            $district = new District();
            $district->id = $key + 1;
            $district->name = $name;
            $district->save();
        }
    }

    /**
     * @return string[]
     */
    public function districts(): array
    {
        return [
            "Bahawalpur", "Bahawalnagar", "Rahim Yar Khan", "D.G Khan", "Layyah", "Muzaffargarh", "Rajanpur", "Gujranwala", "Gujrat", "Hafizabad", "Mandi Baha-ud-din", "Narowal", "Sialkot", "Lahore", "Kasur", "Nankana Sahib", "Sheikhupura", "Multan", "Lodhran", "Khanewal", "Vehari", "Rawalpindi", "Jhelum", "Chakwal", "Attock", "Sahiwal", "Pakpattan", "Okara", "Sargodha", "Khushab", "Mianwali", "Bhakkar", "Faisalabad", "Chiniot", "Toba Tek Singh", "Jhang", "Jampur", "Kot Addu", "Murree", "Talagang", "Taunsa", "Wazirabad"
            ,"Badin", "Dadu", "Ghotki", "Hyderabad", "Jacobabad", "Jamshoro", "Karachi Central", "Kashmore", "Khairpur", "Larkana", "Matiari", "Mirpur Khas", "Naushahro Feroze", "Shaheed Benazirabad", "Qambar Shahdadkot", "Sanghar", "Shikarpur", "Sukkur", "Tando Allahyar", "Tando Muhammad Khan", "Tharparkar", "Thatta", "Umerkot", "Sujawal", "Karachi East", "Karachi South", "Karachi West", "Korangi", "Malir", "Keamari"
            ,"Abbottabad", "Bajaur", "Bannu", "Battagram", "Buner", "Charsadda", "Dera Ismail Khan", "Hangu", "Haripur", "Karak", "Khyber", "Kohat", "Kolai-Palas", "Kurram", "Lakki Marwat", "Lower Chitral", "Lower Dir", "Lower Kohistan", "Lower South Waziristan", "Malakand", "Mansehra", "Mardan", "Mohmand", "North Waziristan", "Nowshera", "Orakzai", "Peshawar", "Shangla", "Swabi", "Swat", "Tank", "Torghar", "Upper Chitral", "Upper Dir", "Upper Kohistan", "Upper South Waziristan", "Allai", "Central Dir District"
            ,"Awaran", "Barkhan", "Kachhi", "Chagai", "Chaman", "Dera Bugti", "Duki", "Gwadar", "Harnai", "Hub", "Jafarabad", "Jhal Magsi", "Kalat", "Kech", "Kharan", "Kohlu", "Khuzdar", "Lasbela", "Loralai", "Mastung", "Musakhel", "Nasirabad", "Nushki", "Qila Abdullah", "Qila Saifullah", "Panjgur", "Pishin", "Quetta", "Sherani", "Sibi", "Sohbatpur", "Surab", "Washuk", "Zhob", "Usta Muhammad", "Ziarat"
            ,'Islamabad Capital Territory (ICT)',"Muzaffarabad", "Hattian Bala", "Neelam Valley", "Mirpur", "Bhimber", "Kotli", "Poonch", "Bagh", "Haveli", "Sudhanoti","Ghanche", "Skardu", "Astore", "Diamer", "Ghizer", "Gilgit", "Hunza", "Kharmang", "Shigar", "Nagar", "Gupis–Yasin", "Tangir", "Darel", "Roundu"
        ];
    }
}
