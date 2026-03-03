<?php

namespace Database\Seeders;

use App\Enums\CauseStatus;
use App\Enums\CauseUpdateType;
use App\Enums\CollaborationType;
use App\Enums\DonationMethodType;
use App\Enums\DonationStatus;
use App\Enums\InquiryStatus;
use App\Enums\NeedCategory;
use App\Enums\NeedStatus;
use App\Enums\SettingType;
use App\Enums\UserRole;
use App\Models\Cause;
use App\Models\CauseImage;
use App\Models\CauseUpdate;
use App\Models\CollaborationInquiry;
use App\Models\ContentBlock;
use App\Models\Donation;
use App\Models\DonationAmountPreset;
use App\Models\DonationMethod;
use App\Models\Faq;
use App\Models\NeedItem;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        CollaborationInquiry::query()->delete();
        Donation::query()->delete();
        CauseImage::query()->delete();
        CauseUpdate::query()->delete();
        DonationAmountPreset::query()->delete();
        NeedItem::query()->delete();
        Faq::query()->delete();
        Testimonial::query()->delete();
        DonationMethod::query()->delete();
        ContentBlock::query()->delete();
        SiteSetting::query()->delete();
        Cause::query()->delete();

        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@croodevcare.test'],
            [
                'name' => 'Croodev Demo Admin',
                'password' => 'CroodevDemo!2026',
                'role' => UserRole::SuperAdmin,
                'is_active' => true,
                'email_verified_at' => now(),
            ],
        );

        $cause = Cause::query()->create([
            'title' => 'Volver a Casa',
            'slug' => 'volver-a-casa',
            'beneficiary_name' => 'Familia Rojas',
            'beneficiary_summary' => 'Una familia necesita adaptar su vivienda y sostener el tratamiento de rehabilitación de su hijo luego de un accidente vial.',
            'status' => CauseStatus::Active,
            'location' => 'San Luis, Argentina',
            'goal_amount' => 18500000,
            'raised_amount' => 7425000,
            'featured' => true,
            'hero_badge' => 'Causa activa',
            'hero_heading' => 'Una casa accesible para volver a empezar',
            'hero_excerpt' => 'Mateo tiene 9 años y atraviesa una rehabilitación intensa. La familia necesita adaptar el hogar, cubrir traslados y sostener estudios médicos clave durante los próximos meses.',
            'short_story' => 'Después de un accidente vial, la rutina de la familia cambió por completo. Hoy el foco está en que Mateo pueda volver a su casa con movilidad segura, continuidad médica y estabilidad básica.',
            'full_story' => implode("\n\n", [
                'En octubre, Mateo sufrió un accidente que cambió por completo el día a día de su familia.',
                'Desde entonces, la prioridad fue estabilizar su salud y comenzar un proceso de rehabilitación exigente, con traslados frecuentes, controles médicos y nuevas necesidades dentro del hogar.',
                'La vivienda actual no está preparada para su movilidad. Hace falta adaptar accesos, reorganizar un espacio de descanso seguro y cubrir gastos que aparecieron de forma repentina: estudios médicos, medicación, insumos, alimentos y movilidad.',
                'La campaña Volver a Casa busca dar una respuesta concreta y transparente. Cada necesidad visible en la plataforma tiene seguimiento, estado y actualización pública.',
                'El objetivo no es solo reunir fondos, sino dar previsibilidad a una familia que necesita enfocarse en la recuperación de su hijo.',
            ]),
            'impact_statement' => 'Cada aporte acelera el regreso seguro al hogar y sostiene la rehabilitación de Mateo.',
            'primary_cta_label' => 'Ayudar ahora',
            'secondary_cta_label' => 'Conocer la historia',
            'manager_name' => 'Equipo Croodev Care',
            'manager_role' => 'Administración de campaña',
            'manager_contact_email' => 'transparencia@croodevcare.test',
            'manager_contact_phone' => '+54 11 5555 0192',
            'donation_disclaimer' => 'Las contribuciones visibles en esta demo son simuladas. La arquitectura está preparada para integrarse con medios de pago reales.',
            'hero_image_path' => 'demo/causes/volver-a-casa/hero.svg',
            'hero_image_alt' => 'La familia Rojas en el patio de su casa',
            'published_at' => now()->subDays(20),
            'last_update_at' => '2026-02-27 12:00:00',
        ]);

        foreach ([
            ['amount' => 2000, 'label' => '$2.000', 'impact_copy' => 'Ayudás con medicación de apoyo', 'sort_order' => 1],
            ['amount' => 5000, 'label' => '$5.000', 'impact_copy' => 'Cubrís parte de un traslado', 'sort_order' => 2],
            ['amount' => 10000, 'label' => '$10.000', 'impact_copy' => 'Aportás a insumos semanales', 'sort_order' => 3],
            ['amount' => 20000, 'label' => '$20.000', 'impact_copy' => 'Impulsás una adaptación concreta del hogar', 'sort_order' => 4],
        ] as $preset) {
            DonationAmountPreset::query()->create([
                'cause_id' => $cause->id,
                'is_active' => true,
                ...$preset,
            ]);
        }

        foreach ([
            ['category' => NeedCategory::MedicalStudies, 'title' => 'Estudios de control', 'description' => 'Resonancias, controles traumatológicos y evaluaciones funcionales.', 'estimated_amount' => 3200000, 'covered_amount' => 1250000, 'status' => NeedStatus::PartiallyCovered, 'urgent' => true, 'sort_order' => 1],
            ['category' => NeedCategory::Transport, 'title' => 'Traslados a rehabilitación', 'description' => 'Movilidad ida y vuelta tres veces por semana durante cuatro meses.', 'estimated_amount' => 2800000, 'covered_amount' => 980000, 'status' => NeedStatus::PartiallyCovered, 'urgent' => true, 'sort_order' => 2],
            ['category' => NeedCategory::HomeAdaptation, 'title' => 'Adaptación del hogar', 'description' => 'Rampas, apoyos, redistribución del cuarto y accesibilidad básica.', 'estimated_amount' => 6400000, 'covered_amount' => 2200000, 'status' => NeedStatus::PartiallyCovered, 'urgent' => true, 'sort_order' => 3],
            ['category' => NeedCategory::Food, 'title' => 'Alimentos y soporte cotidiano', 'description' => 'Acompañamiento mensual para sostener la organización familiar.', 'estimated_amount' => 1600000, 'covered_amount' => 1600000, 'status' => NeedStatus::Completed, 'urgent' => false, 'sort_order' => 4],
            ['category' => NeedCategory::Rent, 'title' => 'Mes de alquiler puente', 'description' => 'Respiro financiero para enfocar recursos en la recuperación.', 'estimated_amount' => 4500000, 'covered_amount' => 1035000, 'status' => NeedStatus::PartiallyCovered, 'urgent' => false, 'sort_order' => 5],
        ] as $need) {
            NeedItem::query()->create([
                'cause_id' => $cause->id,
                ...$need,
            ]);
        }

        foreach ([
            ['title' => 'Mateo comenzó una nueva etapa de rehabilitación', 'type' => CauseUpdateType::Medical, 'published_at' => '2026-02-12 10:00:00', 'excerpt' => 'Se confirmó un nuevo plan de trabajo físico y ocupacional para las próximas ocho semanas.', 'content' => 'El equipo médico ajustó la frecuencia de las sesiones y recomendó sostener los traslados tres veces por semana. Esto vuelve aún más importante asegurar movilidad y continuidad.', 'image_path' => 'demo/causes/volver-a-casa/update-1.svg'],
            ['title' => 'La familia ya inició la adaptación del dormitorio', 'type' => CauseUpdateType::Progress, 'published_at' => '2026-02-21 16:30:00', 'excerpt' => 'Se liberó espacio para circulación y se definieron cambios mínimos de seguridad.', 'content' => 'Con el primer tramo reunido se comenzó a reorganizar el dormitorio para mejorar el acceso, el descanso y la seguridad diaria.', 'image_path' => 'demo/causes/volver-a-casa/update-2.svg'],
            ['title' => 'Se cubrió por completo el primer bloque de alimentos', 'type' => CauseUpdateType::Milestone, 'published_at' => '2026-02-27 12:00:00', 'excerpt' => 'Una necesidad clave ya figura como completada dentro de la campaña.', 'content' => 'Gracias a los aportes recibidos se cubrió el primer bloque de alimentos y soporte básico, permitiendo concentrar el próximo objetivo en movilidad y adaptación del hogar.', 'image_path' => 'demo/causes/volver-a-casa/update-3.svg'],
        ] as $update) {
            CauseUpdate::query()->create([
                'cause_id' => $cause->id,
                ...$update,
            ]);
        }

        foreach ([
            ['path' => 'demo/causes/volver-a-casa/habitacion.svg', 'alt' => 'Habitación en proceso de adaptación', 'caption' => 'El cuarto necesita circulación segura y apoyo lateral.', 'featured' => true, 'sort_order' => 1],
            ['path' => 'demo/causes/volver-a-casa/traslado.svg', 'alt' => 'Traslado a una sesión de rehabilitación', 'caption' => 'Cada semana implica varios viajes al centro médico.', 'featured' => true, 'sort_order' => 2],
            ['path' => 'demo/causes/volver-a-casa/rehabilitacion.svg', 'alt' => 'Sesión de rehabilitación física', 'caption' => 'La continuidad del tratamiento es una prioridad.', 'featured' => false, 'sort_order' => 3],
            ['path' => 'demo/causes/volver-a-casa/gallery-1.svg', 'alt' => 'Entrada principal de la vivienda', 'caption' => 'La entrada actual requiere una solución de acceso segura.', 'featured' => true, 'sort_order' => 4],
            ['path' => 'demo/causes/volver-a-casa/gallery-2.svg', 'alt' => 'Materiales para una adaptación básica', 'caption' => 'Se priorizan cambios simples pero de alto impacto.', 'featured' => true, 'sort_order' => 5],
            ['path' => 'demo/causes/volver-a-casa/gallery-3.svg', 'alt' => 'Jornada de rehabilitación', 'caption' => 'El tratamiento sostenido mejora autonomía y calidad de vida.', 'featured' => false, 'sort_order' => 6],
        ] as $image) {
            CauseImage::query()->create([
                'cause_id' => $cause->id,
                ...$image,
            ]);
        }

        foreach ([
            ['question' => '¿Quién administra esta campaña?', 'answer' => 'La campaña está administrada por un equipo verificado y cada actualización queda reflejada en el panel y en el sitio público.', 'sort_order' => 1],
            ['question' => '¿Cómo se muestra el uso de los fondos?', 'answer' => 'Las necesidades se publican con estado, monto estimado y cobertura parcial o total. Las actualizaciones permiten seguir el avance de la causa.', 'sort_order' => 2],
            ['question' => '¿Puedo colaborar de otra forma además de donar?', 'answer' => 'Sí. La plataforma contempla difusión, alianzas, ayuda logística y contacto directo para colaboraciones específicas.', 'sort_order' => 3],
            ['question' => '¿La demo usa pagos reales?', 'answer' => 'No. Esta demo utiliza un gateway fake para validar experiencia y arquitectura. El sistema está preparado para integrar Stripe, Mercado Pago o transferencia real.', 'sort_order' => 4],
        ] as $faq) {
            Faq::query()->create([
                'cause_id' => $cause->id,
                'is_active' => true,
                ...$faq,
            ]);
        }

        foreach ([
            ['author' => 'Luciana R.', 'role' => 'Tía de Mateo', 'message' => 'La claridad con la que se muestra cada avance nos ayuda a pedir apoyo con respeto y sin confusión.', 'sort_order' => 1],
            ['author' => 'Martín S.', 'role' => 'Kinesiólogo', 'message' => 'Sostener el tratamiento sin interrupciones hace una diferencia real. Poder comunicar eso con transparencia es clave.', 'sort_order' => 2],
        ] as $testimonial) {
            Testimonial::query()->create([
                'cause_id' => $cause->id,
                'is_featured' => true,
                ...$testimonial,
            ]);
        }

        $fakeMethod = DonationMethod::query()->create([
            'type' => DonationMethodType::FakeGateway,
            'title' => 'Pago demo',
            'description' => 'Gateway simulado para demostrar el flujo de aporte.',
            'enabled' => true,
            'is_primary' => true,
            'sort_order' => 1,
            'configuration' => ['provider' => 'fake'],
        ]);

        DonationMethod::query()->create([
            'type' => DonationMethodType::BankTransfer,
            'title' => 'Transferencia / Alias',
            'description' => 'croodev.care.demo',
            'enabled' => true,
            'is_primary' => false,
            'sort_order' => 2,
            'configuration' => ['alias' => 'croodev.care.demo'],
        ]);

        DonationMethod::query()->create([
            'type' => DonationMethodType::Contact,
            'title' => 'Alianzas y ayuda directa',
            'description' => 'contacto@croodevcare.test',
            'enabled' => true,
            'is_primary' => false,
            'sort_order' => 3,
            'configuration' => ['email' => 'contacto@croodevcare.test'],
        ]);

        foreach ([
            ['name' => 'Agustina N.', 'email' => 'agustina@example.com', 'amount' => 25000, 'status' => DonationStatus::Approved, 'completed_at' => '2026-02-10 11:15:00'],
            ['name' => 'Tomás P.', 'email' => 'tomas@example.com', 'amount' => 50000, 'status' => DonationStatus::Approved, 'completed_at' => '2026-02-12 18:20:00'],
            ['name' => 'Estudio Delta', 'email' => 'hola@estudiodelta.test', 'amount' => 250000, 'status' => DonationStatus::Approved, 'completed_at' => '2026-02-15 09:05:00'],
            ['name' => 'Ana y Luis', 'email' => 'ana.luis@example.com', 'amount' => 1000000, 'status' => DonationStatus::Approved, 'completed_at' => '2026-02-18 14:40:00'],
            ['name' => 'Colecta local', 'email' => 'colecta@example.com', 'amount' => 2100000, 'status' => DonationStatus::Approved, 'completed_at' => '2026-02-23 20:10:00'],
            ['name' => 'Fundación Horizonte', 'email' => 'equipo@horizonte.test', 'amount' => 4000000, 'status' => DonationStatus::Approved, 'completed_at' => '2026-02-28 17:35:00'],
        ] as $donation) {
            Donation::query()->create([
                'cause_id' => $cause->id,
                'donation_method_id' => $fakeMethod->id,
                'gateway_type' => DonationMethodType::FakeGateway,
                'donor_name' => $donation['name'],
                'donor_email' => $donation['email'],
                'amount' => $donation['amount'],
                'currency' => 'ARS',
                'status' => $donation['status'],
                'provider_reference' => 'seed-demo',
                'transaction_reference' => 'seed-'.str()->random(12),
                'payload' => ['source' => 'seeder'],
                'completed_at' => $donation['completed_at'],
            ]);
        }

        foreach ([
            ['group' => 'site', 'key' => 'product_name', 'label' => 'Nombre del producto', 'type' => SettingType::Text, 'value' => 'Croodev Care', 'sort_order' => 1],
            ['group' => 'site', 'key' => 'product_tagline', 'label' => 'Tagline', 'type' => SettingType::Text, 'value' => 'Ayuda clara para causas que importan', 'sort_order' => 2],
            ['group' => 'site', 'key' => 'concept_by_label', 'label' => 'Concept label', 'type' => SettingType::Text, 'value' => 'Concept by Croodev', 'sort_order' => 3],
            ['group' => 'contact', 'key' => 'support_email', 'label' => 'Email de soporte', 'type' => SettingType::Email, 'value' => 'hola@croodevcare.test', 'sort_order' => 1],
            ['group' => 'contact', 'key' => 'support_phone', 'label' => 'Teléfono', 'type' => SettingType::Phone, 'value' => '+54 11 5555 0192', 'sort_order' => 2],
            ['group' => 'contact', 'key' => 'whatsapp', 'label' => 'WhatsApp', 'type' => SettingType::Phone, 'value' => '+54 9 11 5555 0192', 'sort_order' => 3],
            ['group' => 'social', 'key' => 'instagram_url', 'label' => 'Instagram', 'type' => SettingType::Url, 'value' => 'https://instagram.com/croodev', 'sort_order' => 1],
            ['group' => 'social', 'key' => 'linkedin_url', 'label' => 'LinkedIn', 'type' => SettingType::Url, 'value' => 'https://linkedin.com/company/croodev', 'sort_order' => 2],
            ['group' => 'legal', 'key' => 'transparency_notice', 'label' => 'Aviso de transparencia', 'type' => SettingType::Textarea, 'value' => 'La campaña es administrada por un equipo verificado. Cada aporte se asigna a necesidades visibles y el avance se actualiza desde el panel.', 'sort_order' => 1],
            ['group' => 'legal', 'key' => 'legal_notice', 'label' => 'Aviso legal', 'type' => SettingType::Textarea, 'value' => 'Demo funcional con fines comerciales y de validación de producto. Los medios de pago activos en este entorno son simulados.', 'sort_order' => 2],
        ] as $setting) {
            SiteSetting::query()->create($setting);
        }

        foreach ([
            ['page' => 'home', 'key' => 'how_to_help_intro', 'title' => 'Cómo ayudar', 'summary' => 'Hay distintas maneras de acompañar.', 'content' => 'Hay distintas maneras de acompañar. Algunas resuelven urgencias inmediatas y otras sostienen el proceso completo.', 'sort_order' => 1],
            ['page' => 'home', 'key' => 'transparency_intro', 'title' => 'Transparencia', 'summary' => 'Toda campaña necesita claridad operativa.', 'content' => 'Toda campaña necesita claridad operativa. Acá se muestra qué se necesita, cuánto se cubrió y cómo evoluciona la causa.', 'sort_order' => 2],
            ['page' => 'global', 'key' => 'footer_blurb', 'title' => 'Footer', 'summary' => 'Demo comercial', 'content' => 'Croodev Care es una demo de producto para causas solidarias con identidad clara, experiencia cuidada y administración real.', 'sort_order' => 3],
        ] as $block) {
            ContentBlock::query()->create($block);
        }

        foreach ([
            ['name' => 'Fundación Norte', 'email' => 'alianzas@norte.test', 'phone' => '+54 11 4444 1200', 'collaboration_type' => CollaborationType::Sponsor, 'message' => 'Queremos evaluar un aporte institucional para la etapa de adaptación del hogar.'],
            ['name' => 'Red de Traslados Solidarios', 'email' => 'contacto@traslados.test', 'phone' => '+54 11 3333 7788', 'collaboration_type' => CollaborationType::Logistics, 'message' => 'Podemos cubrir dos traslados por semana durante marzo.'],
        ] as $inquiry) {
            CollaborationInquiry::query()->create([
                'cause_id' => $cause->id,
                'status' => InquiryStatus::New,
                ...$inquiry,
            ]);
        }

        $admin->refresh();
    }
}
