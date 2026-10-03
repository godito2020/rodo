<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Setting;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Slider;
use App\Models\Banner;
use App\Models\Article;

class RodoEcommerceSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Users
        $admin = User::updateOrCreate(
            ['email' => 'admin@rodoperu.com'],
            [
                'name' => 'Administrador RODOPERU',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'phone' => '+51 987 654 321',
                'dni_ruc' => '20601234567',
                'company_name' => 'RODOPERU S.A.C.',
                'address' => 'Av. Evitamiento Km 8.5, Ate',
                'city' => 'Lima',
                'is_active' => true,
            ]
        );

        $customer = User::updateOrCreate(
            ['email' => 'cliente@gmail.com'],
            [
                'name' => 'Carlos Mendoza Transporte',
                'password' => Hash::make('cliente123'),
                'role' => 'customer',
                'phone' => '+51 999 888 777',
                'dni_ruc' => '10456789012',
                'company_name' => 'Transportes Mendoza E.I.R.L.',
                'address' => 'Av. Argentina 2450',
                'city' => 'Callao',
                'is_active' => true,
            ]
        );

        // 2. Settings
        $settings = [
            // General & Branding
            ['key' => 'site_name', 'value' => 'RODOPERU', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Líderes en Electromovilidad e Implementos Rodoviarios en el Perú', 'group' => 'general'],
            ['key' => 'logo_path', 'value' => 'images/logo/RODO.png', 'group' => 'branding'],
            ['key' => 'favicon_path', 'value' => 'favicon.png', 'group' => 'branding'],
            ['key' => 'currency_symbol', 'value' => 'USD $', 'group' => 'general'],
            ['key' => 'currency_code', 'value' => 'USD', 'group' => 'general'],
            ['key' => 'tax_rate', 'value' => '18', 'group' => 'general'], // IGV
            ['key' => 'catalog_default_show_price', 'value' => '1', 'group' => 'general'],
            ['key' => 'catalog_default_action', 'value' => 'both', 'group' => 'general'], // buy, whatsapp, both

            // Contact & Social
            ['key' => 'company_address', 'value' => 'Av. Evitamiento Km 8.5, Zona Industrial, Ate - Lima, Perú', 'group' => 'contact'],
            ['key' => 'company_phone', 'value' => '+51 (01) 719-8900', 'group' => 'contact'],
            ['key' => 'whatsapp_number', 'value' => '+51987654321', 'group' => 'whatsapp'],
            ['key' => 'whatsapp_welcome_message', 'value' => '¡Hola! Bienvenido a RODOPERU. ¿En qué vehículo eléctrico o implemento rodoviario podemos asesorarte hoy?', 'group' => 'whatsapp'],
            ['key' => 'support_email', 'value' => 'ventas@rodoperu.com', 'group' => 'contact'],
            ['key' => 'sales_email', 'value' => 'cotizaciones@rodoperu.com', 'group' => 'contact'],
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/rodoperu', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/rodoperu_oficial', 'group' => 'social'],
            ['key' => 'social_linkedin', 'value' => 'https://linkedin.com/company/rodoperu', 'group' => 'social'],
            ['key' => 'social_youtube', 'value' => 'https://youtube.com/@rodoperu', 'group' => 'social'],
            ['key' => 'social_tiktok', 'value' => 'https://tiktok.com/@rodoperu', 'group' => 'social'],

            // SMTP Mail Server Settings
            ['key' => 'smtp_host', 'value' => 'smtp.mailtrap.io', 'group' => 'smtp'],
            ['key' => 'smtp_port', 'value' => '2525', 'group' => 'smtp'],
            ['key' => 'smtp_username', 'value' => 'test_user', 'group' => 'smtp'],
            ['key' => 'smtp_password', 'value' => 'test_pass', 'group' => 'smtp'],
            ['key' => 'smtp_encryption', 'value' => 'tls', 'group' => 'smtp'],
            ['key' => 'smtp_from_address', 'value' => 'notificaciones@rodoperu.com', 'group' => 'smtp'],
            ['key' => 'smtp_from_name', 'value' => 'RODOPERU Oficial', 'group' => 'smtp'],

            // Payment Gateways
            ['key' => 'payment_bank_transfer_enabled', 'value' => '1', 'group' => 'payment'],
            ['key' => 'payment_bank_instructions', 'value' => "Banco BCP Cta Cte Dólares: 191-88992233-1-45 (CCI: 002-1910088992233145-56)\nBanco BBVA Cta Cte Soles: 0011-0345-0100098765\nTitular: RODOPERU S.A.C. - RUC 20601234567\nPor favor adjuntar voucher de transferencia para validar su orden.", 'group' => 'payment'],
            ['key' => 'payment_yape_plin_enabled', 'value' => '1', 'group' => 'payment'],
            ['key' => 'payment_yape_phone', 'value' => '987 654 321 (RODOPERU S.A.C.)', 'group' => 'payment'],
            ['key' => 'payment_mercadopago_enabled', 'value' => '1', 'group' => 'payment'],
            ['key' => 'payment_mercadopago_public_key', 'value' => 'TEST-39218209381-120938', 'group' => 'payment'],
            ['key' => 'payment_mercadopago_access_token', 'value' => 'TEST-82910381902830192', 'group' => 'payment'],

            // SEO Positioning Tools
            ['key' => 'seo_meta_title', 'value' => 'RODOPERU | Vehículos Eléctricos y Semirremolques de Alto Rendimiento', 'group' => 'seo'],
            ['key' => 'seo_meta_description', 'value' => 'Encuentra en RODOPERU la más avanzada gama de automóviles y camiones 100% eléctricos, así como semirremolques, tolvas y furgones rodoviarios con garantía y respaldo nacional.', 'group' => 'seo'],
            ['key' => 'seo_meta_keywords', 'value' => 'vehiculos electricos peru, autos electricos lima, semirremolques facchini peru, jmev peru, tolvas basculantes, electromovilidad peru, rodoperu, camion electrico', 'group' => 'seo'],
            ['key' => 'seo_google_analytics', 'value' => '', 'group' => 'seo'],

            // Popup settings
            ['key' => 'popup_active', 'value' => '1', 'group' => 'popup'],
            ['key' => 'popup_title', 'value' => '¡Feria de Electromovilidad RODOPERU!', 'group' => 'popup'],
            ['key' => 'popup_subtitle', 'value' => 'Bono de descuento de hasta $3,000 en vehículos eléctricos e implementos en stock para entrega inmediata.', 'group' => 'popup'],
            ['key' => 'popup_button_text', 'value' => 'Ver Ofertas Exclusivas', 'group' => 'popup'],
            ['key' => 'popup_button_url', 'value' => '/productos?destacados=1', 'group' => 'popup'],
            ['key' => 'popup_countdown', 'value' => date('Y-m-d H:i:s', strtotime('+15 days')), 'group' => 'popup'],
        ];

        foreach ($settings as $s) {
            Setting::updateOrCreate(['key' => $s['key']], ['value' => $s['value'], 'group' => $s['group']]);
        }

        // 3. Brands
        $brandsData = [
            [
                'name' => 'RODO Electric',
                'slug' => 'rodo-electric',
                'description' => 'Línea propia de vehículos y utilitarios 100% eléctricos con soporte y repuestos en todo el Perú.',
                'website' => 'https://rodoperu.com',
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'name' => 'Facchini Rodoviários',
                'slug' => 'facchini-rodoviarios',
                'description' => 'Líder en fabricación de semirremolques, furgones, tolvas y carrocerías de máxima durabilidad.',
                'website' => 'https://www.facchini.com.br',
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'name' => 'JMEV Tech Motors',
                'slug' => 'jmev-tech-motors',
                'description' => 'Innovación global en vehículos eléctricos urbanos con diseño futurista y máxima eficiencia.',
                'website' => 'https://jmev.com.co',
                'is_featured' => true,
                'order' => 3,
            ],
            [
                'name' => 'CATL Power Batteries',
                'slug' => 'catl-power-batteries',
                'description' => 'El mayor fabricante mundial de baterías LFP de alto rendimiento y ultra durabilidad.',
                'website' => 'https://www.catl.com',
                'is_featured' => false,
                'order' => 4,
            ],
            [
                'name' => 'BYD Commercial',
                'slug' => 'byd-commercial',
                'description' => 'Pioneros en electrificación de transporte pesado y flotas comerciales ecológicas.',
                'website' => 'https://byd.com',
                'is_featured' => true,
                'order' => 5,
            ],
        ];

        $createdBrands = [];
        foreach ($brandsData as $b) {
            $createdBrands[$b['slug']] = Brand::updateOrCreate(['slug' => $b['slug']], $b);
        }

        // 4. Categories
        $categoriesData = [
            [
                'name' => 'Vehículos Eléctricos',
                'slug' => 'vehiculos-electricos',
                'description' => 'Automóviles, SUVs, minivans y camiones 100% eléctricos con cero emisiones y bajo costo por km.',
                'order' => 1,
                'children' => [
                    [
                        'name' => 'SUVs Eléctricos',
                        'slug' => 'suvs-electricos',
                        'description' => 'Camionetas familiares y ejecutivas con gran autonomía y tracción inteligente.',
                        'order' => 1,
                    ],
                    [
                        'name' => 'Automóviles Urbanos EV',
                        'slug' => 'automoviles-urbanos-ev',
                        'description' => 'Vehículos compactos ideales para ciudad y flotas de transporte eficiente.',
                        'order' => 2,
                    ],
                    [
                        'name' => 'Camiones y Utilitarios Eléctricos',
                        'slug' => 'camiones-utilitarios-electricos',
                        'description' => 'Furgonetas de carga y camiones ligeros para distribución urbana sostenible.',
                        'order' => 3,
                    ],
                ]
            ],
            [
                'name' => 'Implementos Rodoviarios',
                'slug' => 'implementos-rodoviarios',
                'description' => 'Semirremolques de carga pesada, tolvas, furgones y plataformas diseñadas para la geografía peruana.',
                'order' => 2,
                'children' => [
                    [
                        'name' => 'Semirremolques Furgón',
                        'slug' => 'semirremolques-furgon',
                        'description' => 'Furgones de carga seca y refrigerados para transporte de paquetería y alimentos.',
                        'order' => 1,
                    ],
                    [
                        'name' => 'Tolvas y Basculantes',
                        'slug' => 'tolvas-y-basculantes',
                        'description' => 'Tolvas roqueras y de media caña para minería, áridos y construcción pesada.',
                        'order' => 2,
                    ],
                    [
                        'name' => 'Plataformas y Graneleros',
                        'slug' => 'plataformas-y-graneleros',
                        'description' => 'Plataformas multimodales porta contenedor y graneleros agrícolas de alta capacidad.',
                        'order' => 3,
                    ],
                    [
                        'name' => 'Cisternas y Tanques',
                        'slug' => 'cisternas-y-tanques',
                        'description' => 'Tanques elípticos y cilíndricos para transporte seguro de combustibles y químicos.',
                        'order' => 4,
                    ],
                ]
            ],
        ];

        $createdCategories = [];
        foreach ($categoriesData as $catData) {
            $children = $catData['children'] ?? [];
            unset($catData['children']);

            $parent = Category::updateOrCreate(['slug' => $catData['slug']], $catData);
            $createdCategories[$parent->slug] = $parent;

            foreach ($children as $childData) {
                $childData['parent_id'] = $parent->id;
                $child = Category::updateOrCreate(['slug' => $childData['slug']], $childData);
                $createdCategories[$child->slug] = $child;
            }
        }

        // 5. Products
        $products = [
            [
                'name' => 'RODO EV-600 Grand SUV 100% Eléctrico',
                'slug' => 'rodo-ev-600-grand-suv-electrico',
                'sku' => 'RODO-EV600',
                'category_id' => $createdCategories['suvs-electricos']->id,
                'brand_id' => $createdBrands['rodo-electric']->id,
                'short_description' => 'SUV premium de 7 pasajeros, tracción AWD, autonomía de 520 km y aceleración de 0 a 100 km/h en 4.9s.',
                'description' => '<p>El <strong>RODO EV-600</strong> redefine el transporte corporativo y familiar en el Perú. Equipado con batería de Blade de 86 kWh, ofrece una autonomía real de más de 500 km en ciclo NEDC, perfecta para viajes interurbanos en la costa y sierra peruana.</p><h5>Equipamiento Destacado:</h5><ul><li>Batería de Litio Ferro-Fosfato (LFP) con 8 años o 160,000 km de garantía.</li><li>Carga ultrarrápida del 20% al 80% en tan solo 28 minutos con conector CCS2.</li><li>Pantalla táctil multimedia de 15.6 pulgadas con conectividad Apple CarPlay y Android Auto.</li><li>Asistencia a la conducción ADAS nivel 2.5: Frenado autónomo, control crucero adaptativo y sensor de punto ciego.</li><li>Techo panorámico, asientos de cuero ventilados y sistema de sonido surround de 12 parlantes.</li></ul>',
                'technical_specs' => [
                    ['key' => 'Autonomía NEDC', 'value' => '520 km'],
                    ['key' => 'Capacidad Batería', 'value' => '86.4 kWh LFP'],
                    ['key' => 'Potencia Máxima', 'value' => '408 HP / 300 kW'],
                    ['key' => 'Torque Motor', 'value' => '650 Nm'],
                    ['key' => 'Tracción', 'value' => 'AWD (Doble Motor Inteligente)'],
                    ['key' => 'Carga Rápida DC', 'value' => '120 kW (30 min 20-80%)'],
                    ['key' => 'Carga AC Doméstica', 'value' => 'Wallbox 7.4 kW / 11 kW'],
                    ['key' => 'Capacidad Pasajeros', 'value' => '7 Asientos (3 Filas)'],
                    ['key' => 'Garantía Tren Motriz', 'value' => '8 Años o 160,000 km'],
                ],
                'price' => 45900.00,
                'sale_price' => 42900.00,
                'show_price' => true,
                'action_type' => 'both',
                'stock' => 5,
                'is_featured' => true,
                'meta_title' => 'SUV Eléctrico RODO EV-600 en Perú | Autonomía 520 km | Cotiza Hoy',
                'meta_description' => 'Conoce el nuevo RODO EV-600, SUV 100% eléctrico con 520 km de autonomía y tracción integral. Entrega inmediata en Lima y provincias.',
                'meta_keywords' => 'suv electrico peru, rodo ev600, camioneta electrica lima, autos electricos 7 pasajeros',
            ],
            [
                'name' => 'JMEV EV-2 Urban City Car',
                'slug' => 'jmev-ev-2-urban-city-car',
                'sku' => 'JMEV-EV2',
                'category_id' => $createdCategories['automoviles-urbanos-ev']->id,
                'brand_id' => $createdBrands['jmev-tech-motors']->id,
                'short_description' => 'Automóvil urbano 100% eléctrico, compacto, ágil y con un costo de recarga de tan solo S/ 6 por cada 100 km.',
                'description' => '<p>Inspirado en la electromovilidad inteligente de <strong>JMEV</strong>, el modelo EV-2 es la solución definitiva al tráfico y al alto costo de combustible. Su tamaño compacto permite estacionar en cualquier espacio, mientras su cabina ofrece confort, tecnología y seguridad para 4 ocupantes.</p><h5>Ventajas Clave:</h5><ul><li>Cero emisiones contaminantes y mantenimiento 70% más económico que un auto a gasolina.</li><li>Batería garantizada con refrigeración líquida inteligente.</li><li>Cámara y sensores de retroceso de alta definición.</li><li>Frenos ABS + EBD y doble airbag frontal.</li></ul>',
                'technical_specs' => [
                    ['key' => 'Autonomía', 'value' => '302 km'],
                    ['key' => 'Capacidad Batería', 'value' => '31.9 kWh'],
                    ['key' => 'Potencia Motor', 'value' => '48 HP (35 kW)'],
                    ['key' => 'Velocidad Máxima', 'value' => '102 km/h'],
                    ['key' => 'Tiempo Carga AC', 'value' => '5.5 horas (220V)'],
                    ['key' => 'Carga Rápida DC', 'value' => '40 min (30% a 80%)'],
                    ['key' => 'Capacidad', 'value' => '4 Pasajeros'],
                    ['key' => 'Garantía Batería', 'value' => '6 Años o 120,000 km'],
                ],
                'price' => 17990.00,
                'sale_price' => 16490.00,
                'show_price' => true,
                'action_type' => 'both',
                'stock' => 12,
                'is_featured' => true,
                'meta_title' => 'JMEV EV-2 Auto Eléctrico Urbano en Perú | Precio y Cotización',
                'meta_description' => 'El auto eléctrico más económico y rendidor de Lima. Compra o cotiza por WhatsApp tu JMEV EV-2 en RODOPERU.',
                'meta_keywords' => 'jmev 2 peru, auto electrico barato lima, city car electrico, electromovilidad peru',
            ],
            [
                'name' => 'RODO Cargo E-Van Utilitario Eléctrico 1.5T',
                'slug' => 'rodo-cargo-e-van-utilitario-electrico',
                'sku' => 'RODO-EVAN15',
                'category_id' => $createdCategories['camiones-utilitarios-electricos']->id,
                'brand_id' => $createdBrands['rodo-electric']->id,
                'short_description' => 'Van de reparto comercial 100% eléctrica con 6.8 m³ de volumen de carga y 1,450 kg de capacidad útil.',
                'description' => '<p>Optimizada para última milla, paquetería y logística urbana. Olvídate de los cambios de aceite, embragues y filtros. Con el <strong>RODO Cargo E-Van</strong> maximizas la rentabilidad de tu flota comercial con acceso ilimitado a zonas céntricas sin restricciones ambientales.</p>',
                'technical_specs' => [
                    ['key' => 'Autonomía de Carga', 'value' => '280 km'],
                    ['key' => 'Volumen de Carga', 'value' => '6.8 metros cúbicos'],
                    ['key' => 'Carga Útil Neta', 'value' => '1,450 kg'],
                    ['key' => 'Batería', 'value' => '53.6 kWh CATL LFP'],
                    ['key' => 'Puerta Lateral', 'value' => 'Corrediza + Doble Hoja Trasera 270°'],
                    ['key' => 'Conector de Carga', 'value' => 'Tipo 2 + CCS2 Combo'],
                ],
                'price' => 29800.00,
                'sale_price' => null,
                'show_price' => true,
                'action_type' => 'both',
                'stock' => 8,
                'is_featured' => true,
                'meta_title' => 'Furgoneta Eléctrica de Carga RODO E-Van | Distribución Logística Perú',
                'meta_description' => 'Aumenta tus ganancias logísticas con el furgón 100% eléctrico RODO Cargo E-Van. Asesoría y financiamiento en RODOPERU.',
                'meta_keywords' => 'van electrica peru, furgon de carga electrico, reparto electrico lima, rodo utilitarios',
            ],
            [
                'name' => 'Camión Ligero Eléctrico RODO E-Truck 4.5T',
                'slug' => 'camion-ligero-electrico-rodo-e-truck',
                'sku' => 'RODO-ET45',
                'category_id' => $createdCategories['camiones-utilitarios-electricos']->id,
                'brand_id' => $createdBrands['byd-commercial']->id,
                'short_description' => 'Camión de carga urbana 100% eléctrico con chasis reforzado, capacidad de 4.5 toneladas y cabina ergonómica.',
                'description' => '<p>Diseñado para operaciones logísticas de alta exigencia urbana e interprovincial corta. Compatible con furgón seco, baranda o furgón isotérmico.</p>',
                'technical_specs' => [
                    ['key' => 'Autonomía con Carga', 'value' => '220 km'],
                    ['key' => 'Peso Bruto Vehicular', 'value' => '7,500 kg'],
                    ['key' => 'Carga Neta', 'value' => '4,500 kg'],
                    ['key' => 'Batería', 'value' => '81.14 kWh LiFePO4'],
                    ['key' => 'Freno de Motor', 'value' => 'Regenerativo de 3 Niveles'],
                ],
                'price' => 54500.00,
                'sale_price' => null,
                'show_price' => false, // Set to false to test "Consultar Precio" requirement
                'action_type' => 'whatsapp', // Set to whatsapp only
                'stock' => 4,
                'is_featured' => false,
                'meta_title' => 'Camión Eléctrico RODO E-Truck 4.5 Toneladas | Cotizar en RODOPERU',
                'meta_description' => 'Camión ligero eléctrico para transporte urbano en Perú. Solicita tu cotización por WhatsApp con nuestros especialistas.',
                'meta_keywords' => 'camion electrico peru, camion 4 toneladas electrico, rodo e-truck',
            ],
            [
                'name' => 'Semirremolque Furgón Carga Seca Facchini 3 Ejes',
                'slug' => 'semirremolque-furgon-carga-seca-facchini-3-ejes',
                'sku' => 'FAC-FURGON3E',
                'category_id' => $createdCategories['semirremolques-furgon']->id,
                'brand_id' => $createdBrands['facchini-rodoviarios']->id,
                'short_description' => 'Semirremolque furgón de 14.60 metros en paneles de aluminio corrugado o liso con suspensión neumática Facchini.',
                'description' => '<p>Fabricado con la reconocida calidad de <strong>Facchini Rodoviários</strong>, este semirremolque furgón ofrece la máxima protección para el transporte de cargas paletizadas, electrodomésticos y mercadería de alto valor en las rutas del Perú.</p><h5>Características de Ingeniería:</h5><ul><li>Estructura de chasis en vigas I de acero estructural de alta resistencia ASTM A572.</li><li>Piso en plancha estriada antideslizante o madera de ley tratada tipo machihembrado.</li><li>Sistema de frenos ABS con válvulas Wabco / Haldex y suspensión de 3 ejes con levante neumático en el primer eje.</li><li>Luces 100% LED selladas con cableado protegido contra intemperie y salinidad.</li></ul>',
                'technical_specs' => [
                    ['key' => 'Longitud Exterior', 'value' => '14,600 mm (48 pies / 53 pies opcional)'],
                    ['key' => 'Volumen de Carga', 'value' => '105 m³'],
                    ['key' => 'Configuración de Ejes', 'value' => '3 Ejes en Tándem (1er eje retráctil)'],
                    ['key' => 'Capacidad de Carga', 'value' => '32,000 kg'],
                    ['key' => 'Suspensión', 'value' => 'Neumática integral / Ballestas reforzadas'],
                    ['key' => 'Puertas Traseras', 'value' => 'Doble hoja con 4 cerrojos de acero inox'],
                    ['key' => 'Garantía Estructural', 'value' => '3 Años de respaldo oficial'],
                ],
                'price' => 38500.00,
                'sale_price' => 36900.00,
                'show_price' => true,
                'action_type' => 'both',
                'stock' => 6,
                'is_featured' => true,
                'meta_title' => 'Semirremolque Furgón Facchini 3 Ejes en Perú | RODOPERU Implementos',
                'meta_description' => 'Venta de semirremolques furgón Facchini en Perú. Paneles de alta durabilidad, suspensión neumática y entrega inmediata.',
                'meta_keywords' => 'furgon facchini peru, semirremolque furgon carga seca, carretas facchini lima',
            ],
            [
                'name' => 'Semirremolque Tolva Basculante Media Caña 35m³ Facchini',
                'slug' => 'semirremolque-tolva-basculante-media-cana-facchini',
                'sku' => 'FAC-TOLVA35M',
                'category_id' => $createdCategories['tolvas-y-basculantes']->id,
                'brand_id' => $createdBrands['facchini-rodoviarios']->id,
                'short_description' => 'Tolva basculante en acero antidesgaste Hardox 450 para minería, áridos y movimiento de tierras de alta exigencia.',
                'description' => '<p>La tolva de media caña Facchini optimiza el centro de gravedad reduciendo drásticamente el riesgo de vuelco durante la descarga y facilitando el deslizamiento del material sin adherencias.</p>',
                'technical_specs' => [
                    ['key' => 'Capacidad Volumétrica', 'value' => '35 metros cúbicos'],
                    ['key' => 'Material del Cuerpo', 'value' => 'Acero HARDOX 450 de alta resistencia al impacto'],
                    ['key' => 'Cilindro Hidráulico', 'value' => 'Telescópico frontal de 5 etapas Hyva'],
                    ['key' => 'Ejes', 'value' => '3 Ejes tubulares de 13 toneladas'],
                    ['key' => 'Ángulo de Basculamiento', 'value' => '47 grados'],
                ],
                'price' => 46000.00,
                'sale_price' => null,
                'show_price' => true,
                'action_type' => 'both',
                'stock' => 3,
                'is_featured' => true,
                'meta_title' => 'Tolva Basculante Media Caña Facchini 35m3 | Minería y Obras Perú',
                'meta_description' => 'Tolva basculante en acero Hardox para transporte minero y de áridos. Calidad Facchini en RODOPERU.',
                'meta_keywords' => 'tolva basculante facchini, carreta tolva peru, semirremolque basculante',
            ],
            [
                'name' => 'Semirremolque Plataforma Multimodal Porta Contenedor',
                'slug' => 'semirremolque-plataforma-multimodal-porta-contenedor',
                'sku' => 'FAC-PLATAFORMA',
                'category_id' => $createdCategories['plataformas-y-graneleros']->id,
                'brand_id' => $createdBrands['facchini-rodoviarios']->id,
                'short_description' => 'Plataforma plana de 13.5m equipada con 12 locks para contenedores marítimos de 20 y 40 pies, y estacas desmontables.',
                'description' => '<p>Ideal para empresas de transporte que buscan versatilidad: puede cargar contenedores ISO, carga general, sacos, maquinaria y perfiles de acero con total seguridad.</p>',
                'technical_specs' => [
                    ['key' => 'Longitud', 'value' => '13,500 mm'],
                    ['key' => 'Locks Portacontenedor', 'value' => '12 Twist Locks retráctiles'],
                    ['key' => 'Capacidad', 'value' => '35 Toneladas'],
                    ['key' => 'Ejes', 'value' => '3 Ejes con suspensión mecánica o de aire'],
                ],
                'price' => 28500.00,
                'sale_price' => 26900.00,
                'show_price' => true,
                'action_type' => 'both',
                'stock' => 7,
                'is_featured' => false,
                'meta_title' => 'Plataforma Multimodal Facchini Porta Contenedor | RODOPERU',
                'meta_description' => 'Plataformas planas y portacontenedores para transporte intermodal en puertos del Callao y Paita.',
                'meta_keywords' => 'plataforma portacontenedor, carreta plataforma facchini peru',
            ],
            [
                'name' => 'Semirremolque Cisterna Tanque de Combustible 10,000 Gal',
                'slug' => 'semirremolque-cisterna-combustible-10000-galones',
                'sku' => 'FAC-CIST10K',
                'category_id' => $createdCategories['cisternas-y-tanques']->id,
                'brand_id' => $createdBrands['facchini-rodoviarios']->id,
                'short_description' => 'Cisterna elíptica fabricada en acero al carbono o inoxidable con 4 compartimentos para diésel y gasolinas.',
                'description' => '<p>Certificada según normas de Osinergmin y DOT 406 para el transporte seguro de hidrocarburos con sistema de carga ventral Bottom Loading y vapor recovery.</p>',
                'technical_specs' => [
                    ['key' => 'Capacidad', 'value' => '10,000 Galones (aprox. 38,000 Litros)'],
                    ['key' => 'Compartimentos', 'value' => '4 Compartimentos independientes con rompeolas'],
                    ['key' => 'Sistema de Descarga', 'value' => 'Bottom Loading API con recuperación de vapores'],
                    ['key' => 'Normativa', 'value' => 'Osinergmin / DOT 406'],
                ],
                'price' => 59000.00,
                'sale_price' => null,
                'show_price' => false, // Hidden price to require quote
                'action_type' => 'whatsapp',
                'stock' => 2,
                'is_featured' => false,
                'meta_title' => 'Cisterna de Combustible 10000 Galones Facchini | RODOPERU',
                'meta_description' => 'Cotiza cisternas para hidrocarburos con homologación técnica completa en RODOPERU.',
                'meta_keywords' => 'cisterna combustible peru, tanque hidrocarburos facchini',
            ],
        ];

        foreach ($products as $pData) {
            $product = Product::updateOrCreate(['slug' => $pData['slug']], $pData);

            // Generate clean image asset representation for product
            $imageFile = 'uploads/products/' . $product->slug . '-main.svg';
            self::generateProductSvg(public_path($imageFile), $product->name, $product->sku, $product->category->name ?? 'RODOPERU');

            ProductImage::updateOrCreate(
                ['product_id' => $product->id, 'is_primary' => true],
                ['image_path' => $imageFile, 'order' => 1]
            );

            // Add secondary image
            $imageFile2 = 'uploads/products/' . $product->slug . '-sec.svg';
            self::generateProductSvg(public_path($imageFile2), $product->name . ' (Detalle Técnico)', $product->sku . '-2', 'Especificación');
            ProductImage::updateOrCreate(
                ['product_id' => $product->id, 'image_path' => $imageFile2],
                ['is_primary' => false, 'order' => 2]
            );
        }

        // 6. Sliders
        $sliders = [
            [
                'title' => 'Nueva Era de Electromovilidad en el Perú',
                'subtitle' => 'Descubre la línea de vehículos 100% eléctricos de alta autonomía y tecnología de punta.',
                'badge' => '⚡ 100% ELÉCTRICO · CERO EMISIONES',
                'button_text' => 'Explorar Gama Eléctrica',
                'button_url' => '/productos?categoria=vehiculos-electricos',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Semirremolques Facchini: Máxima Potencia Rodoviaria',
                'subtitle' => 'Ingeniería brasileña de prestigio mundial adaptada a los caminos más desafiantes del Perú.',
                'badge' => '🚛 RESISTENCIA SUPERIOR · 3 AÑOS GARANTÍA',
                'button_text' => 'Ver Semirremolques',
                'button_url' => '/productos?categoria=implementos-rodoviarios',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Soluciones Integrales para Flotas y Transporte Pesado',
                'subtitle' => 'Ahorro de hasta 75% en costo operativo por kilómetro con respaldo técnico permanente.',
                'badge' => '🇵🇪 COBERTURA NACIONAL · REPUESTOS ORIGINALES',
                'button_text' => 'Cotizar Ahora con Asesor',
                'button_url' => '/contacto',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($sliders as $index => $s) {
            $sliderImage = 'uploads/sliders/slider-' . ($index + 1) . '.svg';
            self::generateBannerSvg(public_path($sliderImage), $s['title'], $s['subtitle'], '#0d1b2a', '#00e5ff');
            $s['image_path'] = $sliderImage;
            Slider::updateOrCreate(['title' => $s['title']], $s);
        }

        // 7. Banners
        $banners = [
            [
                'title' => 'Calculadora de Ahorro Eléctrico',
                'subtitle' => 'Calcula cuánto ahorrará tu empresa al migrar tu flota a vehículos 100% eléctricos.',
                'type' => 'middle',
                'button_text' => 'Calcular Ahorro',
                'button_url' => '/contacto?asunto=calculadora_ahorro',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Entrega Inmediata en Semirremolques Tolva y Furgón',
                'subtitle' => 'Unidades listas para salir a trabajar con placa y trámite registral incluido.',
                'type' => 'middle',
                'button_text' => 'Ver Stock Inmediato',
                'button_url' => '/productos?destacados=1',
                'is_active' => true,
                'order' => 2,
            ],
        ];

        foreach ($banners as $index => $b) {
            $bImage = 'uploads/banners/banner-' . ($index + 1) . '.svg';
            self::generateBannerSvg(public_path($bImage), $b['title'], $b['subtitle'], '#1b263b', '#00ff88');
            $b['image_path'] = $bImage;
            Banner::updateOrCreate(['title' => $b['title']], $b);
        }

        // 8. Articles (Novedades / Blog)
        $articles = [
            [
                'title' => 'Electromovilidad en el Perú: Por qué el 2026 es el año ideal para renovar tu flota',
                'slug' => 'electromovilidad-en-el-peru-flotas-2026',
                'summary' => 'Analizamos el retorno de inversión, los incentivos tributarios y el drástico ahorro en costos de combustible que ofrece la electrificación en el transporte.',
                'content' => '<p>La transición hacia la movilidad eléctrica en el Perú ha dejado de ser una promesa de futuro para convertirse en una ventaja competitiva indispensable. Con los precios de los combustibles tradicionales en constante volatilidad, el costo por kilómetro de un automóvil o camión eléctrico representa tan solo una cuarta parte frente a uno diésel o a gasolina.</p><h3>1. Menor Costo de Mantenimiento</h3><p>Los motores eléctricos cuentan con un 80% menos de piezas móviles que un motor de combustión interna. No hay bujías, correas de distribución, cambios periódicos de aceite ni filtros de combustible.</p><h3>2. Disponibilidad de Carga Rápida en el Corredor Nacional</h3><p>Con la expansión de cargadores de alta potencia en la Panamericana y principales ciudades, la autonomía de modelos como el <strong>RODO EV-600</strong> permite recorrer cientos de kilómetros sin interrupciones operativas.</p>',
                'category' => 'Electromovilidad',
                'is_published' => true,
                'meta_title' => 'Electromovilidad en el Perú: Tendencias y Ahorro para Flotas | RODOPERU',
                'meta_description' => 'Descubre las ventajas económicas y operativas de los vehículos eléctricos en Perú con RODOPERU.',
            ],
            [
                'title' => 'Claves para elegir el semirremolque ideal según la ruta y la carga en el Perú',
                'slug' => 'como-elegir-semirremolque-ideal-rutas-peru',
                'summary' => 'Desde la geografía de la sierra central hasta el desierto costero: factores estructurales, tipo de suspensión y materiales de tolva.',
                'content' => '<p>El transporte de carga pesada en las carreteras peruanas exige estándares de ingeniería superlativos. La combinación de curvas cerradas, altitudes superiores a los 4,500 m.s.n.m. y pendientes pronunciadas demanda semirremolques con chasis de alta elasticidad y sistemas de frenos con control electrónico ABS/EBS como los que ofrece Facchini.</p><h3>Suspensión Neumática vs Mecánica</h3><p>Para cargas frágiles, farmacéuticas y paletizadas, la suspensión neumática protege tanto la mercadería como la estructura del vehículo, prolongando además la vida útil de los neumáticos hasta en un 35%.</p>',
                'category' => 'Implementos Rodoviarios',
                'is_published' => true,
                'meta_title' => 'Elegir Semirremolques en Perú: Guía Técnica de Selección | RODOPERU',
                'meta_description' => 'Guía especializada sobre semirremolques Facchini para carreteras peruanas.',
            ],
        ];

        foreach ($articles as $index => $art) {
            $artImg = 'uploads/banners/article-' . ($index + 1) . '.svg';
            self::generateBannerSvg(public_path($artImg), $art['title'], 'Novedades y Noticias RODOPERU', '#0d1b2a', '#38bdf8');
            $art['image_path'] = $artImg;
            Article::updateOrCreate(['slug' => $art['slug']], $art);
        }
    }

    /**
     * Generate SVG Graphic representation for products
     */
    private static function generateProductSvg(string $path, string $title, string $sku, string $category)
    {
        $dir = dirname($path);
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $cleanTitle = htmlspecialchars(mb_strimwidth($title, 0, 36, "..."));
        $cleanSku = htmlspecialchars($sku);
        $cleanCat = htmlspecialchars($category);

        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 500" width="100%" height="100%">
  <defs>
    <linearGradient id="bgGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#0b132b" />
      <stop offset="50%" stop-color="#1c2541" />
      <stop offset="100%" stop-color="#0b132b" />
    </linearGradient>
    <linearGradient id="neonGlow" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" stop-color="#00f2fe" />
      <stop offset="100%" stop-color="#4facfe" />
    </linearGradient>
    <filter id="shadow" x="-20%" y="-20%" width="140%" height="140%">
      <feDropShadow dx="0" dy="10" stdDeviation="15" flood-color="#00f2fe" flood-opacity="0.25"/>
    </filter>
  </defs>

  <!-- Background -->
  <rect width="800" height="500" fill="url(#bgGrad)" />
  
  <!-- Subtle Grid Lines -->
  <line x1="0" y1="380" x2="800" y2="380" stroke="#3a506b" stroke-width="1.5" stroke-dasharray="10 5" opacity="0.4"/>
  <line x1="0" y1="420" x2="800" y2="420" stroke="#3a506b" stroke-width="1" opacity="0.3"/>
  <line x1="0" y1="460" x2="800" y2="460" stroke="#3a506b" stroke-width="0.5" opacity="0.2"/>

  <!-- Brand Watermark / Tech Rings -->
  <circle cx="400" cy="230" r="170" fill="none" stroke="#4facfe" stroke-width="1" opacity="0.15" stroke-dasharray="8 8"/>
  <circle cx="400" cy="230" r="140" fill="none" stroke="#00f2fe" stroke-width="1.5" opacity="0.2"/>

  <!-- Automotive Silhouette Graphic -->
  <g filter="url(#shadow)">
    <!-- Tech Base Platform -->
    <path d="M 160 360 L 220 340 L 580 340 L 640 360 Z" fill="#202d42" stroke="#4facfe" stroke-width="2"/>
    
    <!-- Stylized Modern Vehicle / Transport Body -->
    <path d="M 200 330 C 230 330, 270 290, 310 270 L 460 270 C 510 270, 560 300, 600 330 L 580 335 L 210 335 Z" fill="#24334a" stroke="url(#neonGlow)" stroke-width="3"/>
    
    <!-- Cabin Glass / Tech Glow -->
    <path d="M 320 268 L 440 268 C 475 268, 500 285, 520 305 L 290 305 Z" fill="#00f2fe" opacity="0.45"/>
    
    <!-- Wheels / Axles -->
    <circle cx="260" cy="340" r="38" fill="#111827" stroke="#4facfe" stroke-width="4"/>
    <circle cx="260" cy="340" r="16" fill="#1f2937" stroke="#00f2fe" stroke-width="2"/>
    
    <circle cx="540" cy="340" r="38" fill="#111827" stroke="#4facfe" stroke-width="4"/>
    <circle cx="540" cy="340" r="16" fill="#1f2937" stroke="#00f2fe" stroke-width="2"/>

    <!-- Light Stream / Headlight Beam -->
    <polygon points="590,320 720,290 730,340 595,330" fill="url(#neonGlow)" opacity="0.25"/>
  </g>

  <!-- Tag & Category Badge -->
  <rect x="40" y="35" width="180" height="32" rx="16" fill="#00f2fe" fill-opacity="0.15" stroke="#00f2fe" stroke-width="1.5"/>
  <text x="55" y="56" fill="#00f2fe" font-family="system-ui, sans-serif" font-size="13" font-weight="700" letter-spacing="1">{$cleanCat}</text>

  <!-- SKU Badge -->
  <rect x="630" y="35" width="130" height="32" rx="6" fill="#1f2937" stroke="#374151" stroke-width="1"/>
  <text x="695" y="56" fill="#9ca3af" font-family="system-ui, monospace" font-size="13" font-weight="600" text-anchor="middle">SKU: {$cleanSku}</text>

  <!-- Product Title & Enterprise Watermark -->
  <text x="40" y="445" fill="#ffffff" font-family="system-ui, sans-serif" font-size="22" font-weight="700">{$cleanTitle}</text>
  <text x="40" y="472" fill="#00f2fe" font-family="system-ui, sans-serif" font-size="14" font-weight="600" letter-spacing="2">RODOPERU · GARANTÍA Y CALIDAD OFICIAL</text>
  
  <text x="760" y="472" fill="#64748b" font-family="system-ui, sans-serif" font-size="13" font-weight="600" text-anchor="end">FUSION FACCHINI - JMEV</text>
</svg>
SVG;

        file_put_contents($path, $svg);
    }

    /**
     * Generate SVG Graphic representation for sliders and banners
     */
    private static function generateBannerSvg(string $path, string $title, string $subtitle, string $bgDark, string $accent)
    {
        $dir = dirname($path);
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $cleanTitle = htmlspecialchars(mb_strimwidth($title, 0, 48, "..."));
        $cleanSub = htmlspecialchars(mb_strimwidth($subtitle, 0, 75, "..."));
        $cleanAccent = htmlspecialchars($accent);
        $cleanBg = htmlspecialchars($bgDark);

        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1600 700" width="100%" height="100%">
  <defs>
    <linearGradient id="sliderGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="{$cleanBg}" />
      <stop offset="60%" stop-color="#0a101d" />
      <stop offset="100%" stop-color="{$cleanBg}" />
    </linearGradient>
    <linearGradient id="neonBar" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" stop-color="{$cleanAccent}" />
      <stop offset="100%" stop-color="#00f2fe" />
    </linearGradient>
  </defs>

  <rect width="1600" height="700" fill="url(#sliderGrad)" />
  
  <!-- Modern Tech Geometry -->
  <path d="M 0 0 L 700 0 L 500 700 L 0 700 Z" fill="#ffffff" opacity="0.02"/>
  <circle cx="1300" cy="350" r="300" fill="none" stroke="{$cleanAccent}" stroke-width="2" opacity="0.15" stroke-dasharray="20 15"/>
  <circle cx="1300" cy="350" r="220" fill="none" stroke="#00f2fe" stroke-width="1.5" opacity="0.1"/>

  <!-- Geometric Speed Lines -->
  <line x1="850" y1="200" x2="1550" y2="200" stroke="url(#neonBar)" stroke-width="3" opacity="0.4" stroke-dasharray="150 20"/>
  <line x1="950" y1="350" x2="1550" y2="350" stroke="url(#neonBar)" stroke-width="4" opacity="0.6" stroke-dasharray="250 40"/>
  <line x1="900" y1="500" x2="1500" y2="500" stroke="url(#neonBar)" stroke-width="2" opacity="0.3" stroke-dasharray="80 15"/>

  <!-- Enterprise Tag -->
  <rect x="100" y="140" width="260" height="40" rx="8" fill="{$cleanAccent}" fill-opacity="0.15" stroke="{$cleanAccent}" stroke-width="2"/>
  <text x="120" y="166" fill="{$cleanAccent}" font-family="system-ui, sans-serif" font-size="16" font-weight="800" letter-spacing="2">RODOPERU INDUSTRIAL</text>

  <!-- Big Title -->
  <text x="100" y="270" fill="#ffffff" font-family="system-ui, sans-serif" font-size="46" font-weight="900">{$cleanTitle}</text>
  
  <!-- Subtitle -->
  <text x="100" y="340" fill="#94a3b8" font-family="system-ui, sans-serif" font-size="22" font-weight="400">{$cleanSub}</text>

  <!-- Technical badges bar -->
  <g transform="translate(100, 420)">
    <rect width="200" height="60" rx="8" fill="#1e293b" stroke="#334155" stroke-width="1"/>
    <text x="25" y="30" fill="{$cleanAccent}" font-family="system-ui, sans-serif" font-size="16" font-weight="700">100% ELÉCTRICO</text>
    <text x="25" y="48" fill="#94a3b8" font-family="system-ui, sans-serif" font-size="12">Cero Emisiones</text>

    <rect x="230" width="200" height="60" rx="8" fill="#1e293b" stroke="#334155" stroke-width="1"/>
    <text x="255" y="30" fill="{$cleanAccent}" font-family="system-ui, sans-serif" font-size="16" font-weight="700">FACCHINI TECH</text>
    <text x="255" y="48" fill="#94a3b8" font-family="system-ui, sans-serif" font-size="12">Calidad Rodoviaria</text>

    <rect x="460" width="200" height="60" rx="8" fill="#1e293b" stroke="#334155" stroke-width="1"/>
    <text x="485" y="30" fill="{$cleanAccent}" font-family="system-ui, sans-serif" font-size="16" font-weight="700">SOPORTE TOTAL</text>
    <text x="485" y="48" fill="#94a3b8" font-family="system-ui, sans-serif" font-size="12">Red Nacional Perú</text>
  </g>
</svg>
SVG;

        file_put_contents($path, $svg);
    }
}
