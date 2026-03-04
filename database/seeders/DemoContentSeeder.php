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
            ['email' => 'admin@sleidercalderon.test'],
            [
                'name' => 'Sleider Demo Admin',
                'password' => 'SleiderDemo!2026',
                'role' => UserRole::SuperAdmin,
                'is_active' => true,
                'email_verified_at' => now(),
            ],
        );

        $cause = Cause::query()->create([
            'title' => 'Sleider Calderón',
            'slug' => 'sleider-calderon',
            'beneficiary_name' => 'Sleider Calderón',
            'beneficiary_summary' => 'Sleider atraviesa una recuperación compleja después de un accidente vial. La campaña busca sostener terapias, movilidad diaria y adecuaciones básicas del hogar para que no interrumpa su proceso.',
            'status' => CauseStatus::Active,
            'location' => 'San Luis, Argentina',
            'goal_amount' => 18500000,
            'raised_amount' => 7425000,
            'featured' => true,
            'hero_badge' => 'Causa activa',
            'hero_heading' => 'Una recuperación sostenida y un hogar seguro para Sleider',
            'hero_excerpt' => 'Cada aporte ayuda a cubrir traslados, sesiones de rehabilitación, medicamentos y adecuaciones básicas para que Sleider continúe su recuperación con estabilidad y sin interrupciones.',
            'short_story' => 'Después de un accidente de tránsito, la rutina de Sleider y de su familia cambió por completo. Hoy la prioridad es sostener su rehabilitación y preparar la casa para una nueva etapa de autonomía.',
            'full_story' => implode("\n\n", [
                'Sleider sufrió un accidente vial que obligó a reorganizar por completo su rutina, su tratamiento y la dinámica diaria de toda su familia.',
                'Desde entonces, el foco está puesto en sostener una rehabilitación exigente, con controles médicos, medicación, movilidad frecuente y asistencia para tareas básicas.',
                'La vivienda todavía necesita ajustes concretos para que pueda moverse con mayor seguridad y descanso: accesos, circulación, apoyos y un espacio funcional para su recuperación.',
                'Esta campaña reúne esas necesidades en un solo lugar, con seguimiento visible, actualizaciones públicas y un enfoque claro en la transparencia.',
                'El objetivo es que Sleider pueda concentrarse en recuperar estabilidad, autonomía y calidad de vida sin que la familia cargue sola con todo el costo del proceso.',
            ]),
            'impact_statement' => 'Cada aporte acerca a Sleider a una recuperación más estable, segura y autónoma.',
            'primary_cta_label' => 'Ayudar ahora',
            'secondary_cta_label' => 'Conocer la historia',
            'manager_name' => 'Comité solidario de Sleider',
            'manager_role' => 'Coordinación y seguimiento de la campaña',
            'manager_contact_email' => 'transparencia@sleidercalderon.test',
            'manager_contact_phone' => '+54 11 5555 0192',
            'donation_disclaimer' => 'En esta demo el aporte se registra con un gateway de prueba. Las fotos utilizadas son referenciales y el sistema está preparado para integrarse con pagos reales.',
            'hero_image_path' => 'demo/causes/sleider-calderon/hero.jpg',
            'hero_image_alt' => 'Joven en silla de ruedas durante una jornada de recuperación',
            'published_at' => now()->subDays(20),
            'last_update_at' => '2026-02-27 12:00:00',
        ]);

        foreach ([
            ['amount' => 2000, 'label' => '$2.000', 'impact_copy' => 'Ayudás con medicación de apoyo', 'sort_order' => 1],
            ['amount' => 5000, 'label' => '$5.000', 'impact_copy' => 'Cubrís parte de un traslado', 'sort_order' => 2],
            ['amount' => 10000, 'label' => '$10.000', 'impact_copy' => 'Aportás a una sesión intensiva de rehabilitación', 'sort_order' => 3],
            ['amount' => 20000, 'label' => '$20.000', 'impact_copy' => 'Impulsás una adecuación concreta del hogar', 'sort_order' => 4],
        ] as $preset) {
            DonationAmountPreset::query()->create([
                'cause_id' => $cause->id,
                'is_active' => true,
                ...$preset,
            ]);
        }

        foreach ([
            ['category' => NeedCategory::MedicalStudies, 'title' => 'Controles y estudios médicos', 'description' => 'Evaluaciones funcionales, imágenes y seguimiento clínico para sostener la rehabilitación.', 'estimated_amount' => 3200000, 'covered_amount' => 1250000, 'status' => NeedStatus::PartiallyCovered, 'urgent' => true, 'sort_order' => 1],
            ['category' => NeedCategory::Transport, 'title' => 'Traslados a terapia', 'description' => 'Movilidad ida y vuelta varias veces por semana para controles y sesiones de rehabilitación.', 'estimated_amount' => 2800000, 'covered_amount' => 980000, 'status' => NeedStatus::PartiallyCovered, 'urgent' => true, 'sort_order' => 2],
            ['category' => NeedCategory::HomeAdaptation, 'title' => 'Adecuación del hogar', 'description' => 'Accesos, apoyos, circulación segura y un espacio de descanso preparado para su nueva rutina.', 'estimated_amount' => 6400000, 'covered_amount' => 2200000, 'status' => NeedStatus::PartiallyCovered, 'urgent' => true, 'sort_order' => 3],
            ['category' => NeedCategory::Food, 'title' => 'Alimentos y soporte diario', 'description' => 'Cobertura básica para que la familia pueda enfocarse en el tratamiento y la recuperación.', 'estimated_amount' => 1600000, 'covered_amount' => 1600000, 'status' => NeedStatus::Completed, 'urgent' => false, 'sort_order' => 4],
            ['category' => NeedCategory::Rent, 'title' => 'Respiro financiero mensual', 'description' => 'Apoyo temporal para sostener gastos fijos mientras la familia reorganiza ingresos y cuidados.', 'estimated_amount' => 4500000, 'covered_amount' => 1035000, 'status' => NeedStatus::PartiallyCovered, 'urgent' => false, 'sort_order' => 5],
        ] as $need) {
            NeedItem::query()->create([
                'cause_id' => $cause->id,
                ...$need,
            ]);
        }

        foreach ([
            ['title' => 'Sleider inició una nueva etapa de rehabilitación', 'type' => CauseUpdateType::Medical, 'published_at' => '2026-02-12 10:00:00', 'excerpt' => 'El equipo médico definió un esquema más intensivo para las próximas semanas.', 'content' => 'Los profesionales recomendaron sostener la continuidad de las sesiones y evitar interrupciones en traslados, controles y apoyo cotidiano. Eso vuelve prioritario asegurar movilidad y previsibilidad.', 'image_path' => 'demo/causes/sleider-calderon/update-1.jpg'],
            ['title' => 'Comenzó la adecuación del espacio de descanso', 'type' => CauseUpdateType::Progress, 'published_at' => '2026-02-21 16:30:00', 'excerpt' => 'Se reorganizó una parte del hogar para mejorar circulación y seguridad.', 'content' => 'Con el primer tramo cubierto se inició una adaptación básica del espacio donde Sleider pasa más horas, priorizando accesos, apoyo físico y una rutina diaria más segura.', 'image_path' => 'demo/causes/sleider-calderon/update-2.jpg'],
            ['title' => 'Se completó el primer bloque de apoyo diario', 'type' => CauseUpdateType::Milestone, 'published_at' => '2026-02-27 12:00:00', 'excerpt' => 'Una necesidad importante ya figura como cubierta dentro de la campaña.', 'content' => 'Los aportes recibidos permitieron cubrir el primer bloque de alimentos y soporte esencial. El siguiente foco está puesto en la terapia continua y la adecuación del hogar.', 'image_path' => 'demo/causes/sleider-calderon/update-3.jpg'],
        ] as $update) {
            CauseUpdate::query()->create([
                'cause_id' => $cause->id,
                ...$update,
            ]);
        }

        foreach ([
            ['path' => 'demo/causes/sleider-calderon/story-1.jpg', 'alt' => 'Sleider en un entorno interior durante su recuperación', 'caption' => 'La campaña también busca adaptar su espacio cotidiano para que pueda moverse con seguridad.', 'featured' => true, 'sort_order' => 1],
            ['path' => 'demo/causes/sleider-calderon/story-2.jpg', 'alt' => 'Acompañamiento durante una jornada de movilidad asistida', 'caption' => 'Cada traslado y cada instancia de apoyo marcan una diferencia real en el proceso.', 'featured' => true, 'sort_order' => 2],
            ['path' => 'demo/causes/sleider-calderon/story-3.jpg', 'alt' => 'Momento de seguimiento médico en el proceso de recuperación', 'caption' => 'La continuidad clínica requiere tiempo, organización y recursos sostenidos.', 'featured' => false, 'sort_order' => 3],
            ['path' => 'demo/causes/sleider-calderon/gallery-1.jpg', 'alt' => 'Movilidad urbana en silla de ruedas', 'caption' => 'La campaña prioriza autonomía, seguridad y accesibilidad en cada traslado.', 'featured' => true, 'sort_order' => 4],
            ['path' => 'demo/causes/sleider-calderon/gallery-2.jpg', 'alt' => 'Rutina diaria adaptada con apoyo tecnológico', 'caption' => 'Recuperarse también implica reorganizar tareas y hábitos dentro del hogar.', 'featured' => true, 'sort_order' => 5],
            ['path' => 'demo/causes/sleider-calderon/gallery-3.jpg', 'alt' => 'Espacio doméstico accesible para una nueva etapa', 'caption' => 'La meta es construir una rutina más estable, humana y sostenible para Sleider.', 'featured' => false, 'sort_order' => 6],
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
            ['question' => '¿La demo usa pagos reales y fotos del caso?', 'answer' => 'No. Esta demo usa un gateway fake y fotografías de referencia con licencia abierta para validar experiencia, contenido y arquitectura antes de una integración productiva.', 'sort_order' => 4],
        ] as $faq) {
            Faq::query()->create([
                'cause_id' => $cause->id,
                'is_active' => true,
                ...$faq,
            ]);
        }

        foreach ([
            ['author' => 'Mariela C.', 'role' => 'Familiar cercana', 'message' => 'Tener cada necesidad ordenada y visible nos ayuda a pedir apoyo con claridad y sin perder de vista lo urgente.', 'sort_order' => 1],
            ['author' => 'Julián P.', 'role' => 'Equipo terapéutico', 'message' => 'La recuperación depende mucho de la continuidad. Poder mostrar avances y prioridades de forma transparente cambia la conversación.', 'sort_order' => 2],
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
            'description' => 'sleider.calderon.demo',
            'enabled' => true,
            'is_primary' => false,
            'sort_order' => 2,
            'configuration' => ['alias' => 'sleider.calderon.demo'],
        ]);

        DonationMethod::query()->create([
            'type' => DonationMethodType::Contact,
            'title' => 'Alianzas y ayuda directa',
            'description' => 'contacto@sleidercalderon.test',
            'enabled' => true,
            'is_primary' => false,
            'sort_order' => 3,
            'configuration' => ['email' => 'contacto@sleidercalderon.test'],
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
            ['group' => 'site', 'key' => 'product_name', 'label' => 'Nombre del producto', 'type' => SettingType::Text, 'value' => 'Sleider Calderón', 'sort_order' => 1],
            ['group' => 'site', 'key' => 'product_tagline', 'label' => 'Tagline', 'type' => SettingType::Text, 'value' => 'Campaña solidaria para su recuperación', 'sort_order' => 2],
            ['group' => 'site', 'key' => 'concept_by_label', 'label' => 'Concept label', 'type' => SettingType::Text, 'value' => 'Concepto por', 'sort_order' => 3],
            ['group' => 'contact', 'key' => 'support_email', 'label' => 'Email de soporte', 'type' => SettingType::Email, 'value' => 'contacto@sleidercalderon.test', 'sort_order' => 1],
            ['group' => 'contact', 'key' => 'support_phone', 'label' => 'Teléfono', 'type' => SettingType::Phone, 'value' => '+54 11 5555 0192', 'sort_order' => 2],
            ['group' => 'contact', 'key' => 'whatsapp', 'label' => 'WhatsApp', 'type' => SettingType::Phone, 'value' => '+54 9 11 5555 0192', 'sort_order' => 3],
            ['group' => 'social', 'key' => 'instagram_url', 'label' => 'Instagram', 'type' => SettingType::Url, 'value' => 'https://instagram.com/croodev', 'sort_order' => 1],
            ['group' => 'social', 'key' => 'linkedin_url', 'label' => 'LinkedIn', 'type' => SettingType::Url, 'value' => 'https://linkedin.com/company/croodev', 'sort_order' => 2],
            ['group' => 'legal', 'key' => 'transparency_notice', 'label' => 'Aviso de transparencia', 'type' => SettingType::Textarea, 'value' => 'La campaña es administrada por un equipo verificado. Cada aporte se asigna a necesidades visibles y el avance se actualiza desde el panel.', 'sort_order' => 1],
            ['group' => 'legal', 'key' => 'legal_notice', 'label' => 'Aviso legal', 'type' => SettingType::Textarea, 'value' => 'Demo funcional con fines comerciales y de validación de producto. Los medios de pago son simulados y las fotografías corresponden a referencias visuales con licencia abierta.', 'sort_order' => 2],
        ] as $setting) {
            SiteSetting::query()->create($setting);
        }

        foreach ([
            ['page' => 'home', 'key' => 'how_to_help_intro', 'title' => 'Cómo ayudar', 'summary' => 'Hay distintas maneras de acompañar.', 'content' => 'Hay distintas maneras de acompañar. Algunas resuelven urgencias inmediatas y otras sostienen el proceso completo.', 'sort_order' => 1],
            ['page' => 'home', 'key' => 'transparency_intro', 'title' => 'Transparencia', 'summary' => 'Toda campaña necesita claridad operativa.', 'content' => 'Toda campaña necesita claridad operativa. Acá se muestra qué se necesita, cuánto se cubrió y cómo evoluciona la causa.', 'sort_order' => 2],
            ['page' => 'global', 'key' => 'footer_blurb', 'title' => 'Footer', 'summary' => 'Campaña solidaria', 'content' => 'Una campaña pensada para ordenar prioridades, mostrar avances reales y facilitar ayuda inmediata con una experiencia clara y humana.', 'sort_order' => 3],
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
