<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\News;
use App\Models\Product;
use App\Models\Director;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        User::firstOrCreate(
            ['email' => 'admin@musashi.co.id'],
            [
                'name' => 'Musashi Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Board of Directors
        $directors = [
            [
                'name' => 'Asep Nugraha',
                'title' => 'President Director',
                'bio' => 'Serving as President Director of PT Musashi Auto Parts Indonesia with extensive leadership and dedication in advancing precision manufacturing, human resource empowerment, and the global Musashi Monozukuri spirit.',
                'photo' => '/images/bod/asep-nugraha.jpg',
                'order' => 1,
            ],
            [
                'name' => 'Armandes Wimal',
                'title' => 'Director',
                'bio' => 'Directing operations, quality consistency, and domestic market synergies with PT Astra Honda Motor and partner automotive original equipment manufacturers.',
                'photo' => '/images/bod/armandes-wimal.jpg',
                'order' => 2,
            ],
            [
                'name' => 'Junji Nakashima',
                'title' => 'Director',
                'bio' => 'Overseeing technical transfer, integrated production systems, and alignment with Musashi Seimitsu Industry global research standards.',
                'photo' => '/images/bod/junji-nakashima.jpg',
                'order' => 3,
            ],
        ];

        foreach ($directors as $dir) {
            Director::updateOrCreate(['name' => $dir['name']], $dir);
        }

        // 3. Products
        $products = [
            // 2-Wheelers
            [
                'name' => '2W Automation Transmission Gear, Shaft & Camshaft',
                'slug' => '2w-automation-transmission-gear-shaft-camshaft',
                'category' => '2-Wheelers',
                'description' => 'High precision transmission shafts and gears forged and machined with sub-micron tolerances for smooth torque delivery in modern automatic motorcycles.',
                'features' => ['High fatigue endurance forged steel', 'Ultra-precise tooth geometry finishing', 'Optimized heat treatment for long service life'],
                'specifications' => 'Material: SCM420H / SCr420H | Heat Treatment: Carburized & Quenched | Application: Automatic 2W Scooters & Motorcycles',
                'image' => '/images/products/product-gear-shaft.jpg',
                'order' => 1,
                'is_featured' => true,
            ],
            [
                'name' => '2W Transmission Gear',
                'slug' => '2w-transmission-gear',
                'category' => '2-Wheelers',
                'description' => 'Precision-forged motorcycle transmission gears delivering optimal gear mesh, silent running, and superior tooth surface load resistance.',
                'features' => ['Precision cold forging technology', 'Low vibration tooth profile', 'Proven performance under high RPM conditions'],
                'specifications' => 'Module: 1.5 - 2.5 | Material: High Tensile Alloy Steel | Finish: Shot-peened and honed',
                'image' => '/images/products/product-transmission-gear.jpg',
                'order' => 2,
                'is_featured' => true,
            ],
            [
                'name' => 'Cub / MC Mission',
                'slug' => 'cub-mc-mission',
                'category' => '2-Wheelers',
                'description' => 'Integrated transmission gear train and mission assembly engineered for light underbone and sport motorcycles with high thermal stability.',
                'features' => ['Compact multi-ratio gear cluster', 'Integrated shift fork engagement', 'High efficiency torque transfer'],
                'specifications' => 'Configuration: 4-speed / 5-speed / 6-speed | Application: Cub & Sport 2W',
                'image' => '/images/products/product-mc-mission.jpg',
                'order' => 3,
                'is_featured' => false,
            ],
            [
                'name' => 'AT Mission Assembly',
                'slug' => 'at-mission',
                'category' => '2-Wheelers',
                'description' => 'Continuous transmission components tailored for scooter drivetrains, engineered for smooth acceleration and minimal frictional losses.',
                'features' => ['Optimized drive face angle', 'Lightweight balanced rotating mass', 'Enhanced anti-wear coating'],
                'specifications' => 'Type: CVT Drive Subassembly | Efficiency: >94% mechanical transfer',
                'image' => '/images/products/product-at-mission.jpg',
                'order' => 4,
                'is_featured' => true,
            ],
            [
                'name' => 'Camshaft (2W)',
                'slug' => 'camshaft-2w',
                'category' => '2-Wheelers',
                'description' => 'Chilled cast iron and forged steel camshafts with precision lobing for optimal valve timing and engine thermal efficiency.',
                'features' => ['Laser verified cam profile geometry', 'Ultra-hard lobe surface', 'Reduced internal engine friction'],
                'specifications' => 'Surface Hardness: HRC 58-62 | Runout Tolerance: <0.005mm',
                'image' => '/images/products/product-cam.jpg',
                'order' => 5,
                'is_featured' => false,
            ],
            [
                'name' => 'Clutch Piston / One-Way Clutch (OWC)',
                'slug' => 'clutch-piston-owc',
                'category' => '2-Wheelers',
                'description' => 'Precision clutch actuating pistons and one-way starter clutches ensuring instantaneous engagement and reliable engine startup.',
                'features' => ['High responsiveness sprag mechanism', 'Hydraulic leak-free sealing precision', 'Robust anti-shock design'],
                'specifications' => 'Torque Rating: Up to 180 Nm | Max Overrunning Speed: 12,000 RPM',
                'image' => '/images/products/product-clutch.jpg',
                'order' => 6,
                'is_featured' => false,
            ],

            // 4-Wheelers
            [
                'name' => '4W Transmission Gear & Shaft',
                'slug' => '4w-transmission-gear-shaft',
                'category' => '4-Wheelers',
                'description' => 'Heavy-duty manual and automatic passenger car transmission shafts and gears crafted with integrated precision forging.',
                'features' => ['Deep carburized case depth', 'Optimized micro-geometry against pitting', 'Strict acoustic NVH standards compliance'],
                'specifications' => 'Standards: JIS / ISO Class 5 | Torque Capacity: Up to 450 Nm',
                'image' => '/images/products/product-4w-gear.jpg',
                'order' => 7,
                'is_featured' => true,
            ],
            [
                'name' => 'Planetary Assembly',
                'slug' => 'planetary-assembly',
                'category' => '4-Wheelers',
                'description' => 'Compact planetary reduction assemblies for automatic transmissions and hybrid drive axles providing multi-stage torque multiplication.',
                'features' => ['High power density in compact envelop', 'Precision needle bearing mounts', 'High tooth contact ratio'],
                'specifications' => 'Ratio: Multi-stage customized | Application: 4W Automatic & Hybrid Transmissions',
                'image' => '/images/products/product-planetary.jpg',
                'order' => 8,
                'is_featured' => true,
            ],
            [
                'name' => 'Differential Assembly',
                'slug' => 'differential-assembly',
                'category' => '4-Wheelers',
                'description' => 'Precision differential gear sets and cross shafts ensuring stable cornering, balanced torque distribution, and longevity under heavy loads.',
                'features' => ['Bevel gear forging without machining requirement for teeth', 'High shock resistance', 'Global OEM trusted design'],
                'specifications' => 'Type: Open / Limited Slip Diff components | Application: Front / Rear axle assemblies',
                'image' => '/images/products/product-diff.jpg',
                'order' => 9,
                'is_featured' => true,
            ],
            [
                'name' => 'Ball Joint Assembly',
                'slug' => 'ball-joint-assembly',
                'category' => '4-Wheelers',
                'description' => 'Steering and suspension ball joints built with high tensile forged housings for vehicle safety, ride quality, and driver control.',
                'features' => ['Sealed zero-maintenance boot', 'High pull-out and push-out strength', 'Smooth articulation with minimal breakaway torque'],
                'specifications' => 'Articulation Angle: ±35° | Testing: 1,000,000 cycle endurance certified',
                'image' => '/images/products/product-balljoint.jpg',
                'order' => 10,
                'is_featured' => false,
            ],
            [
                'name' => '4W Camshaft',
                'slug' => '4w-camshaft',
                'category' => '4-Wheelers',
                'description' => 'Assembled and monobloc camshafts engineered for modern low-emission gasoline and hybrid automobile powerplants.',
                'features' => ['Weight reduction through hollow shaft design', 'Precision sintered cam lobes', 'Low friction journal finish'],
                'specifications' => 'Diameter: 22-30mm | Application: DOHC 16V / 24V 4W engines',
                'image' => '/images/products/product-4w-camshaft.jpg',
                'order' => 11,
                'is_featured' => false,
            ],
            [
                'name' => 'Hub Clutch',
                'slug' => 'hub-clutch',
                'category' => '4-Wheelers',
                'description' => 'Precision splined hub clutches providing smooth torque transfer and dampening drivetrain torsional vibrations.',
                'features' => ['High precision broached splines', 'Surface induction hardened', 'Damped harmonic resonance'],
                'specifications' => 'Spline Standard: DIN 5480 / JIS D 2001',
                'image' => '/images/products/product-hub-clutch.jpg',
                'order' => 12,
                'is_featured' => false,
            ],

            // EV / Future
            [
                'name' => 'e-Axle for 2-Wheelers & Light EVs',
                'slug' => 'e-axle-2-wheelers',
                'category' => 'EV / Future Mobility',
                'description' => 'All-in-one integrated electric drive unit combining high-efficiency motor, gearbox reduction, and intelligent inverter for electric 2-wheelers.',
                'features' => ['Ultra-compact 3-in-1 integration', 'System efficiency exceeding 92%', 'IP67 water and dust ingress protection'],
                'specifications' => 'Continuous Power: 3.5 kW - 8.0 kW | Peak Torque: 140 Nm at wheel | Voltage: 48V / 72V',
                'image' => '/images/products/product-e-axle.jpg',
                'images' => [
                    '/images/products/product-e-axle.jpg',
                    '/images/products/product-mc-mission.jpg',
                    '/images/business/mobility.jpg',
                ],
                'order' => 13,
                'is_featured' => true,
            ],
            [
                'name' => 'Innovative Energy Storage Module & BMS',
                'slug' => 'energy-storage-bms',
                'category' => 'EV / Future Mobility',
                'description' => 'Jointly developed with Musashi Energy Solutions and Mitsubishi Electric, offering rapid charging and high-cycle longevity for modern electrified transit.',
                'features' => ['Lithium-ion capacitor hybrid tech', 'Over 100,000 rapid charge/discharge cycles', 'Intelligent cell balancing'],
                'specifications' => 'Operating Temp: -30°C to +65°C | Chemistry: Hybrid LIC / Li-ion | Target: Rolling Stock, EV Fleets',
                'image' => '/images/products/product-energy-storage.jpg',
                'images' => [
                    '/images/products/product-energy-storage.jpg',
                    '/images/business/energy.jpg',
                    '/images/news/news-mitsubishi-musashi.jpg',
                ],
                'order' => 14,
                'is_featured' => true,
            ],
        ];

        foreach ($products as $prod) {
            Product::updateOrCreate(['slug' => $prod['slug']], $prod);
        }

        // 4. News
        $newsList = [
            [
                'title' => 'Mitsubishi Electric and Musashi Energy Solutions Sign Partnership and Co-Development Contract',
                'slug' => 'mitsubishi-electric-and-musashi-energy-solutions-sign-partnership',
                'category' => 'Partnership',
                'excerpt' => 'Signing of a landmark partnership agreement for Innovative Energy Storage Devices and Battery Management Systems (BMSs) to advance railway and e-mobility electrification.',
                'content' => 'Mitsubishi Electric Corporation (Chiyoda-ku, Tokyo) and Musashi Energy Solutions Co., Ltd. (Hokuto City, Yamanashi Prefecture), a subsidiary of Musashi Seimitsu Industry Co., Ltd. (Toyohashi City, Aichi Prefecture), announced today their signing of a partnership and co-development agreement for Innovative Energy Storage Devices to be incorporated into Innovative Energy Storage Modules, and Battery Management Systems (BMSs) that monitor and control battery usage for railway operators and rolling stock manufacturers.

This cooperation combines Mitsubishi Electric’s advanced power electronics and rail equipment know-how with Musashi’s proprietary high-power density cell storage technologies, driving accelerated carbon neutrality in public transit systems globally.',
                'image' => '/images/news/news-mitsubishi-musashi.jpg',
                'images' => [
                    '/images/news/news-mitsubishi-musashi.jpg',
                    '/images/products/product-energy-storage.jpg',
                    '/images/business/energy.jpg',
                    '/images/hero/hero-plant.jpg',
                ],
                'is_featured' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Further Accelerating E-Mobility Business Development in Eastern Africa',
                'slug' => 'further-accelerating-e-mobility-business-development-in-eastern-africa',
                'category' => 'Global Business',
                'excerpt' => 'Musashi Seimitsu announces investment and strategic collaboration with Dodai Group, an EV startup specializing in the assembly and sale of two-wheeled electric vehicles in Addis Ababa, Ethiopia.',
                'content' => 'Musashi Seimitsu Industry Co., Ltd. (Global Headquarters: Toyohashi-city, Aichi, Japan; President and CEO: Hiroshi Otsuka) is pleased to announce about the investment and collaboration with Dodai Group, Inc., an EV startup based in Ethiopia that specializes in the assembly and sale of two-wheeled electric vehicles (Headquartered in Addis Ababa, Ethiopia, President and CEO: Yuma Sasaki, “Dodai”).

Through this initiative, Musashi aims to introduce high-reliability electrified powertrains and accelerate green mobility transitions in rapidly growing emerging markets across Africa.',
                'image' => '/images/news/news-africa-mobility.jpg',
                'images' => [
                    '/images/news/news-africa-mobility.jpg',
                    '/images/business/mobility.jpg',
                    '/images/products/product-e-axle.jpg',
                ],
                'is_featured' => true,
                'published_at' => now()->subDays(12),
            ],
            [
                'title' => 'IMOS+ All About Motorcycles: Musashi Indonesia Showcases EV Powertrain Innovations',
                'slug' => 'imos-motorcycles-ports-accessories-lifestyle-map-in',
                'category' => 'Exhibition',
                'excerpt' => 'PT Musashi Auto Parts Indonesia participates actively in Indonesia International Motorcycle Show (IMOS+), supporting the government program to accelerate the EV ecosystem and achieve net-zero emissions by 2060.',
                'content' => 'Musashi Indonesia (MAP-IN) is participating in the Indonesian government’s program to accelerate the electric vehicle (EV) ecosystem and achieve net-zero emissions by 2060.

At IMOS+, Musashi Indonesia exhibited next-generation integrated e-Axles for 2-wheelers, ultra-precision lightweight gears, and shared visions for sustainable local manufacturing together with Astra Group and key stakeholders.',
                'image' => '/images/news/news-imos-ev.jpg',
                'images' => [
                    '/images/news/news-imos-ev.jpg',
                    '/images/hero/hero-automotive.jpg',
                    '/images/products/product-transmission-gear.jpg',
                    '/images/products/product-mc-mission.jpg',
                    '/images/products/product-planetary.jpg',
                ],
                'is_featured' => true,
                'published_at' => now()->subDays(20),
            ],
            [
                'title' => 'Musashi Indonesia Celebrates 28 Years of Precision Monozukuri Excellence',
                'slug' => 'musashi-indonesia-celebrates-28-years-monozukuri-excellence',
                'category' => 'Corporate',
                'excerpt' => 'Established in March 1996, PT Musashi Auto Parts Indonesia marks continuous milestones in high precision manufacturing across Cikarang and Karawang Plants.',
                'content' => 'Since commencing commercial production in EJIP Cikarang in 1996 and expanding to Suryacipta Karawang in 2006, PT Musashi Auto Parts Indonesia has grown into an indispensable manufacturing base with over 1,600 dedicated team members.

Under the Musashi 100th Year Vision, our workforce commits to breaking barriers and pursuing continuous innovation for customers across Indonesia and Southeast Asia.',
                'image' => '/images/news/news-anniversary.jpg',
                'images' => [
                    '/images/news/news-anniversary.jpg',
                    '/images/hero/hero-plant.jpg',
                ],
                'is_featured' => false,
                'published_at' => now()->subDays(35),
            ],
            [
                'title' => 'Musashi AI Visual Inspection Systems Deployed Across Indonesian Plants',
                'slug' => 'musashi-ai-visual-inspection-systems-deployed-indonesia',
                'category' => 'Technology',
                'excerpt' => 'Implementation of sub-micron optical AI inspection algorithms enhances zero-defect precision manufacturing at Karawang and Cikarang facilities.',
                'content' => 'Musashi Auto Parts Indonesia successfully deployed advanced AI-powered automated optical inspection (AOI) lines across high-volume gear manufacturing cells in Karawang Plant.

By integrating deep learning edge computing with ultra-precision Monozukuri methodologies, MAP-IN achieves higher inspection accuracy, real-time defect prevention, and streamlined ergonomics for quality engineers.',
                'image' => '/images/hero/hero-plant.jpg',
                'images' => [
                    '/images/hero/hero-plant.jpg',
                    '/images/business/industry.jpg',
                    '/images/products/product-4w-gear.jpg',
                ],
                'is_featured' => true,
                'published_at' => now()->subDays(45),
            ],
            [
                'title' => 'Astra Green Company Clean Energy Transition: Rooftop Solar PV Expansion',
                'slug' => 'astra-green-company-solar-pv-transition',
                'category' => 'Sustainability',
                'excerpt' => 'PT Musashi Auto Parts Indonesia expands solar photovoltaic systems atop Cikarang plant, offsetting over 1,200 metric tons of CO2 annually.',
                'content' => 'Demonstrating solid commitment to carbon neutrality by 2050, PT Musashi Auto Parts Indonesia inaugurates the phase 2 rooftop solar PV installation at EJIP Cikarang.

The system delivers clean renewable energy directly to precision machining centers, reducing corporate carbon footprints while contributing to Astra Green Company standards.',
                'image' => '/images/business/energy.jpg',
                'is_featured' => false,
                'published_at' => now()->subDays(60),
            ],
        ];

        foreach ($newsList as $item) {
            News::updateOrCreate(['slug' => $item['slug']], $item);
        }

        // 5. Default Hero Slides
        \App\Models\LandingPageSetting::saveHeroSlides(\App\Models\LandingPageSetting::defaultHeroSlides());
    }
}
