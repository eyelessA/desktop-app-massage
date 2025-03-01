<?php

namespace Database\Seeders;

use App\Models\Therapist;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = [
            'name' => ['Дмитрий', 'Иван', 'Алексей', 'Мария', 'Ольга', 'Петр', 'Анна', 'Сергей', 'Елена', 'Виктор'],
            'surname' => ['Иванов', 'Антонов', 'Петров', 'Смирнова', 'Васильева', 'Федоров', 'Кузнецова', 'Попов', 'Коваленко', 'Григорьев'],
            'description' => [
                'Опытный специалист в области массажа с более чем 10-летним стажем. Он имеет глубокие знания анатомии и физиологии, что позволяет ему подбирать индивидуальные методики массажа для каждого клиента. Дмитрий специализируется на расслабляющих и восстанавливающих техниках, таких как шведский и спортивный массаж.',
                'Профессиональный массажист с богатым опытом работы в сфере релаксации и оздоровления. Иван владеет различными техниками массажа, включая глубокотканевый, лимфодренажный и антистрессовый массажи. Он умеет эффективно снимать напряжение, улучшать циркуляцию крови и восстанавливать силы после тяжелых нагрузок.',
                'Эксперт в области медицинского массажа с большим опытом работы в реабилитации пациентов после травм. Алексей применяет уникальные методики для восстановления подвижности суставов и снятия болевого синдрома. Он проводит индивидуальные сеансы для каждого пациента, используя комплексный подход.',
                'Специалист по детскому массажу, обладает уникальными методиками работы с детьми. Она помогает улучшить осанку, укрепить мышцы и повысить общую гибкость. Мария также использует расслабляющие техники для снятия стресса у детей. Она опытно работает с детьми различных возрастных групп, включая младенцев.',
                'Профессионал в области антицеллюлитного массажа и коррекции фигуры. Она использует комбинацию техник, включая вакуумный и лимфодренажный массажи, чтобы помочь своим клиентам улучшить состояние кожи и избавиться от отеков. Ольга обладает глубокими знаниями в области косметологии и питания.',
                'Массажист, специализирующийся на спортивном массаже для профессиональных атлетов и любителей спорта. Он помогает спортсменам восстановиться после интенсивных тренировок, снимает напряжение и улучшает гибкость. Петр также проводит сеансы для улучшения общей физической формы и профилактики травм.',
                'Специалист по рефлексотерапии и массажу головы. Она использует сочетание традиционных восточных техник и современных методов массажа для восстановления энергетического баланса в организме. Анна помогает избавиться от головных болей, бессонницы и улучшить общее самочувствие.',
                'Эксперт в области шведского массажа и массажа спины. Он специализируется на расслабляющих и восстанавливающих методах работы с позвоночником. Сергей помогает своим клиентам избавиться от болей в спине и шее, а также улучшить осанку и общую подвижность тела.',
                'Опытный массажист, работающая в области расслабляющего массажа. Она использует технику шведского массажа, чтобы снять стресс, расслабить мышцы и улучшить кровообращение. Елена также предлагает сеансы ароматерапевтического массажа, который помогает своим клиентам погрузиться в атмосферу покоя и расслабления.',
                'Высококвалифицированный специалист по массажу лица и шеи. Он использует сочетание техник для улучшения циркуляции крови и уменьшения выраженности морщин. Виктор работает с клиентами, которые хотят улучшить состояние кожи, расслабиться и снять напряжение в области лица и шеи.'
            ],
            'rating' => [3, 1, 5, 4, 4, 5, 3, 4, 5, 4],
            'image' => [
                'https://massage.spb.ru/wp-content/uploads/2021/03/msgst-05.jpg',
                'https://massage.spb.ru/wp-content/uploads/2021/03/msgst-04.jpg',
                'https://massage.spb.ru/wp-content/uploads/2024/08/vit.jpg',
                'https://massage.spb.ru/wp-content/uploads/2022/06/anastasia.jpg',
                'https://massage.spb.ru/wp-content/uploads/2023/03/elena.jpg',
                'https://massage.spb.ru/wp-content/uploads/2024/04/alex.jpg',
                'https://massage.spb.ru/wp-content/uploads/2021/03/msgst-17.jpg',
                'https://massage.spb.ru/wp-content/uploads/2022/04/msgst-02.jpg',
                'https://massage.spb.ru/wp-content/uploads/2021/03/msgst-19.jpg',
                'https://massage.spb.ru/wp-content/uploads/2021/03/msgst-02.jpg',
            ]
        ];

        foreach ($data['name'] as $index => $name) {
            Therapist::query()->create([
                'name' => $name,
                'surname' => $data['surname'][$index],
                'description' => $data['description'][$index],
                'rating' => $data['rating'][$index],
                'image' => $data['image'][$index],
            ]);
        }
    }
}
