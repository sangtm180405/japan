<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ListeningExercise;

class ListeningExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exercises = [
            // N5 Level
            [
                'title' => 'Chào hỏi cơ bản',
                'description' => 'Luyện nghe các câu chào hỏi cơ bản trong tiếng Nhật',
                'level' => 1,
                'audio_file' => '/audio/listening/n5_greetings.mp3',
                'transcript' => 'こんにちは。おはようございます。こんばんは。さようなら。',
                'transcript_romaji' => 'Konnichiwa. Ohayou gozaimasu. Konbanwa. Sayounara.',
                'transcript_english' => 'Hello. Good morning. Good evening. Goodbye.',
                'transcript_vietnamese' => 'Xin chào. Chào buổi sáng. Chào buổi tối. Tạm biệt.',
                'duration' => 15,
                'difficulty_level' => 1,
                'questions' => [
                    [
                        'type' => 'multiple_choice',
                        'question' => 'Câu chào "こんにちは" được sử dụng khi nào?',
                        'options' => ['Buổi sáng', 'Buổi trưa', 'Buổi tối', 'Khi đi ngủ']
                    ],
                    [
                        'type' => 'multiple_choice',
                        'question' => 'Câu chào "おはようございます" có nghĩa là gì?',
                        'options' => ['Chào buổi trưa', 'Chào buổi sáng', 'Chào buổi tối', 'Tạm biệt']
                    ],
                    [
                        'type' => 'fill_blank',
                        'question' => 'Điền từ còn thiếu: "こんばんは" có nghĩa là "Chào buổi ___"',
                        'options' => []
                    ]
                ],
                'correct_answers' => ['Buổi trưa', 'Chào buổi sáng', 'tối'],
                'points' => 15,
                'is_active' => true
            ],
            [
                'title' => 'Số đếm từ 1-10',
                'description' => 'Luyện nghe số đếm từ 1 đến 10 trong tiếng Nhật',
                'level' => 1,
                'audio_file' => '/audio/listening/n5_numbers.mp3',
                'transcript' => 'いち、に、さん、よん、ご、ろく、なな、はち、きゅう、じゅう',
                'transcript_romaji' => 'Ichi, ni, san, yon, go, roku, nana, hachi, kyuu, juu',
                'transcript_english' => 'One, two, three, four, five, six, seven, eight, nine, ten',
                'transcript_vietnamese' => 'Một, hai, ba, bốn, năm, sáu, bảy, tám, chín, mười',
                'duration' => 20,
                'difficulty_level' => 1,
                'questions' => [
                    [
                        'type' => 'multiple_choice',
                        'question' => 'Số "さん" trong tiếng Nhật là số mấy?',
                        'options' => ['1', '2', '3', '4']
                    ],
                    [
                        'type' => 'multiple_choice',
                        'question' => 'Số "じゅう" trong tiếng Nhật là số mấy?',
                        'options' => ['8', '9', '10', '11']
                    ],
                    [
                        'type' => 'fill_blank',
                        'question' => 'Điền số: "はち" là số ___',
                        'options' => []
                    ]
                ],
                'correct_answers' => ['3', '10', '8'],
                'points' => 15,
                'is_active' => true
            ],
            [
                'title' => 'Gia đình',
                'description' => 'Luyện nghe từ vựng về gia đình',
                'level' => 1,
                'audio_file' => '/audio/listening/n5_family.mp3',
                'transcript' => 'おとうさん、おかあさん、おにいさん、おねえさん、いもうと、おとうと',
                'transcript_romaji' => 'Otousan, okaasan, oniisan, oneesan, imouto, otouto',
                'transcript_english' => 'Father, mother, older brother, older sister, younger sister, younger brother',
                'transcript_vietnamese' => 'Bố, mẹ, anh trai, chị gái, em gái, em trai',
                'duration' => 18,
                'difficulty_level' => 1,
                'questions' => [
                    [
                        'type' => 'multiple_choice',
                        'question' => '"おとうさん" có nghĩa là gì?',
                        'options' => ['Mẹ', 'Bố', 'Anh trai', 'Chị gái']
                    ],
                    [
                        'type' => 'multiple_choice',
                        'question' => '"おかあさん" có nghĩa là gì?',
                        'options' => ['Bố', 'Mẹ', 'Anh trai', 'Chị gái']
                    ],
                    [
                        'type' => 'true_false',
                        'question' => '"おにいさん" có nghĩa là "anh trai"',
                        'options' => []
                    ]
                ],
                'correct_answers' => ['Bố', 'Mẹ', 'true'],
                'points' => 15,
                'is_active' => true
            ],

            // N4 Level
            [
                'title' => 'Hội thoại trong nhà hàng',
                'description' => 'Luyện nghe hội thoại khi đi ăn nhà hàng',
                'level' => 2,
                'audio_file' => '/audio/listening/n4_restaurant.mp3',
                'transcript' => 'いらっしゃいませ。メニューをどうぞ。何にしますか。すみません、注文をお願いします。',
                'transcript_romaji' => 'Irasshaimase. Menyuu wo douzo. Nani ni shimasu ka. Sumimasen, chuumon wo onegaishimasu.',
                'transcript_english' => 'Welcome. Here is the menu. What would you like? Excuse me, I would like to order.',
                'transcript_vietnamese' => 'Chào mừng. Đây là thực đơn. Bạn muốn gì? Xin lỗi, tôi muốn gọi món.',
                'duration' => 25,
                'difficulty_level' => 2,
                'questions' => [
                    [
                        'type' => 'multiple_choice',
                        'question' => 'Câu "いらっしゃいませ" được sử dụng khi nào?',
                        'options' => ['Khi gọi món', 'Khi chào khách', 'Khi thanh toán', 'Khi xin lỗi']
                    ],
                    [
                        'type' => 'multiple_choice',
                        'question' => '"メニューをどうぞ" có nghĩa là gì?',
                        'options' => ['Cảm ơn', 'Đây là thực đơn', 'Xin lỗi', 'Tạm biệt']
                    ],
                    [
                        'type' => 'fill_blank',
                        'question' => 'Điền từ: "注文" có nghĩa là "___ món"',
                        'options' => []
                    ]
                ],
                'correct_answers' => ['Khi chào khách', 'Đây là thực đơn', 'gọi'],
                'points' => 20,
                'is_active' => true
            ],
            [
                'title' => 'Hỏi đường',
                'description' => 'Luyện nghe hội thoại hỏi đường',
                'level' => 2,
                'audio_file' => '/audio/listening/n4_directions.mp3',
                'transcript' => 'すみません、駅はどこですか。まっすぐ行ってください。右に曲がってください。',
                'transcript_romaji' => 'Sumimasen, eki wa doko desu ka. Massugu itte kudasai. Migi ni magatte kudasai.',
                'transcript_english' => 'Excuse me, where is the station? Please go straight. Please turn right.',
                'transcript_vietnamese' => 'Xin lỗi, ga tàu ở đâu? Hãy đi thẳng. Hãy rẽ phải.',
                'duration' => 22,
                'difficulty_level' => 2,
                'questions' => [
                    [
                        'type' => 'multiple_choice',
                        'question' => '"駅はどこですか" có nghĩa là gì?',
                        'options' => ['Ga tàu ở đâu?', 'Nhà ga ở đâu?', 'Trạm xe ở đâu?', 'Bến xe ở đâu?']
                    ],
                    [
                        'type' => 'multiple_choice',
                        'question' => '"まっすぐ行ってください" có nghĩa là gì?',
                        'options' => ['Hãy rẽ trái', 'Hãy rẽ phải', 'Hãy đi thẳng', 'Hãy quay lại']
                    ],
                    [
                        'type' => 'true_false',
                        'question' => '"右に曲がってください" có nghĩa là "Hãy rẽ trái"',
                        'options' => []
                    ]
                ],
                'correct_answers' => ['Ga tàu ở đâu?', 'Hãy đi thẳng', 'false'],
                'points' => 20,
                'is_active' => true
            ],

            // N3 Level
            [
                'title' => 'Hội thoại tại công ty',
                'description' => 'Luyện nghe hội thoại trong môi trường công sở',
                'level' => 3,
                'audio_file' => '/audio/listening/n3_office.mp3',
                'transcript' => 'お疲れ様です。会議は何時からですか。資料の準備はできていますか。',
                'transcript_romaji' => 'Otsukaresama desu. Kaigi wa nanji kara desu ka. Shiryou no junbi wa dekite imasu ka.',
                'transcript_english' => 'Good work. What time does the meeting start? Are the materials ready?',
                'transcript_vietnamese' => 'Chúc bạn làm việc tốt. Cuộc họp bắt đầu lúc mấy giờ? Tài liệu đã chuẩn bị chưa?',
                'duration' => 30,
                'difficulty_level' => 3,
                'questions' => [
                    [
                        'type' => 'multiple_choice',
                        'question' => '"お疲れ様です" được sử dụng khi nào?',
                        'options' => ['Khi chào buổi sáng', 'Khi kết thúc công việc', 'Khi xin lỗi', 'Khi cảm ơn']
                    ],
                    [
                        'type' => 'multiple_choice',
                        'question' => '"会議" có nghĩa là gì?',
                        'options' => ['Cuộc họp', 'Công ty', 'Văn phòng', 'Dự án']
                    ],
                    [
                        'type' => 'fill_blank',
                        'question' => 'Điền từ: "資料" có nghĩa là "___"',
                        'options' => []
                    ]
                ],
                'correct_answers' => ['Khi kết thúc công việc', 'Cuộc họp', 'tài liệu'],
                'points' => 25,
                'is_active' => true
            ],
            [
                'title' => 'Đặt phòng khách sạn',
                'description' => 'Luyện nghe hội thoại đặt phòng khách sạn',
                'level' => 3,
                'audio_file' => '/audio/listening/n3_hotel.mp3',
                'transcript' => 'すみません、部屋を予約したいのですが。何泊ですか。チェックインは何時からですか。',
                'transcript_romaji' => 'Sumimasen, heya wo yoyaku shitai no desu ga. Nanpaku desu ka. Check-in wa nanji kara desu ka.',
                'transcript_english' => 'Excuse me, I would like to make a reservation. How many nights? What time is check-in?',
                'transcript_vietnamese' => 'Xin lỗi, tôi muốn đặt phòng. Mấy đêm? Giờ check-in là mấy giờ?',
                'duration' => 28,
                'difficulty_level' => 3,
                'questions' => [
                    [
                        'type' => 'multiple_choice',
                        'question' => '"予約" có nghĩa là gì?',
                        'options' => ['Đặt trước', 'Hủy bỏ', 'Thay đổi', 'Xác nhận']
                    ],
                    [
                        'type' => 'multiple_choice',
                        'question' => '"何泊" có nghĩa là gì?',
                        'options' => ['Mấy đêm', 'Mấy người', 'Mấy phòng', 'Mấy giờ']
                    ],
                    [
                        'type' => 'true_false',
                        'question' => '"チェックイン" là từ tiếng Anh được sử dụng trong tiếng Nhật',
                        'options' => []
                    ]
                ],
                'correct_answers' => ['Đặt trước', 'Mấy đêm', 'true'],
                'points' => 25,
                'is_active' => true
            ],

            // N2 Level
            [
                'title' => 'Thảo luận về dự án',
                'description' => 'Luyện nghe cuộc thảo luận về dự án công việc',
                'level' => 4,
                'audio_file' => '/audio/listening/n2_project.mp3',
                'transcript' => 'プロジェクトの進捗状況はいかがですか。来週までに完了できるでしょうか。',
                'transcript_romaji' => 'Purojekuto no shinchoku joukyou wa ikaga desu ka. Raishuu made ni kanryou dekiru deshou ka.',
                'transcript_english' => 'How is the project progress? Can it be completed by next week?',
                'transcript_vietnamese' => 'Tình hình tiến độ dự án thế nào? Có thể hoàn thành trước tuần sau không?',
                'duration' => 35,
                'difficulty_level' => 4,
                'questions' => [
                    [
                        'type' => 'multiple_choice',
                        'question' => '"進捗" có nghĩa là gì?',
                        'options' => ['Tiến độ', 'Kế hoạch', 'Mục tiêu', 'Kết quả']
                    ],
                    [
                        'type' => 'multiple_choice',
                        'question' => '"完了" có nghĩa là gì?',
                        'options' => ['Bắt đầu', 'Hoàn thành', 'Tạm dừng', 'Tiếp tục']
                    ],
                    [
                        'type' => 'fill_blank',
                        'question' => 'Điền từ: "来週" có nghĩa là "___ sau"',
                        'options' => []
                    ]
                ],
                'correct_answers' => ['Tiến độ', 'Hoàn thành', 'tuần'],
                'points' => 30,
                'is_active' => true
            ],
            [
                'title' => 'Phỏng vấn xin việc',
                'description' => 'Luyện nghe cuộc phỏng vấn xin việc',
                'level' => 4,
                'audio_file' => '/audio/listening/n2_interview.mp3',
                'transcript' => '自己紹介をお願いします。なぜこの会社を選んだのですか。',
                'transcript_romaji' => 'Jikoshoukai wo onegaishimasu. Naze kono kaisha wo eranda no desu ka.',
                'transcript_english' => 'Please introduce yourself. Why did you choose this company?',
                'transcript_vietnamese' => 'Vui lòng tự giới thiệu. Tại sao bạn chọn công ty này?',
                'duration' => 32,
                'difficulty_level' => 4,
                'questions' => [
                    [
                        'type' => 'multiple_choice',
                        'question' => '"自己紹介" có nghĩa là gì?',
                        'options' => ['Tự giới thiệu', 'Giới thiệu công ty', 'Giới thiệu sản phẩm', 'Giới thiệu đồng nghiệp']
                    ],
                    [
                        'type' => 'multiple_choice',
                        'question' => '"会社" có nghĩa là gì?',
                        'options' => ['Trường học', 'Công ty', 'Bệnh viện', 'Ngân hàng']
                    ],
                    [
                        'type' => 'true_false',
                        'question' => '"なぜ" có nghĩa là "tại sao"',
                        'options' => []
                    ]
                ],
                'correct_answers' => ['Tự giới thiệu', 'Công ty', 'true'],
                'points' => 30,
                'is_active' => true
            ],

            // N1 Level
            [
                'title' => 'Thảo luận chính trị',
                'description' => 'Luyện nghe cuộc thảo luận về chính trị',
                'level' => 5,
                'audio_file' => '/audio/listening/n1_politics.mp3',
                'transcript' => '経済政策についてどう思いますか。この法案は国民にどのような影響を与えるでしょうか。',
                'transcript_romaji' => 'Keizai seisaku ni tsuite dou omoimasu ka. Kono houan wa kokumin ni dono you na eikyou wo ataeru deshou ka.',
                'transcript_english' => 'What do you think about economic policy? What kind of impact will this bill have on the people?',
                'transcript_vietnamese' => 'Bạn nghĩ gì về chính sách kinh tế? Dự luật này sẽ có tác động gì đến người dân?',
                'duration' => 40,
                'difficulty_level' => 5,
                'questions' => [
                    [
                        'type' => 'multiple_choice',
                        'question' => '"経済政策" có nghĩa là gì?',
                        'options' => ['Chính sách kinh tế', 'Chính sách xã hội', 'Chính sách giáo dục', 'Chính sách y tế']
                    ],
                    [
                        'type' => 'multiple_choice',
                        'question' => '"法案" có nghĩa là gì?',
                        'options' => ['Luật', 'Dự luật', 'Nghị định', 'Quy định']
                    ],
                    [
                        'type' => 'fill_blank',
                        'question' => 'Điền từ: "国民" có nghĩa là "___"',
                        'options' => []
                    ]
                ],
                'correct_answers' => ['Chính sách kinh tế', 'Dự luật', 'người dân'],
                'points' => 35,
                'is_active' => true
            ],
            [
                'title' => 'Thảo luận khoa học',
                'description' => 'Luyện nghe cuộc thảo luận về khoa học',
                'level' => 5,
                'audio_file' => '/audio/listening/n1_science.mp3',
                'transcript' => 'この研究結果は非常に興味深いですね。今後の研究計画はいかがですか。',
                'transcript_romaji' => 'Kono kenkyuu kekka wa hijou ni kyoumi fukai desu ne. Kongo no kenkyuu keikaku wa ikaga desu ka.',
                'transcript_english' => 'This research result is very interesting. What are your future research plans?',
                'transcript_vietnamese' => 'Kết quả nghiên cứu này rất thú vị. Kế hoạch nghiên cứu trong tương lai thế nào?',
                'duration' => 38,
                'difficulty_level' => 5,
                'questions' => [
                    [
                        'type' => 'multiple_choice',
                        'question' => '"研究結果" có nghĩa là gì?',
                        'options' => ['Kết quả nghiên cứu', 'Kế hoạch nghiên cứu', 'Phương pháp nghiên cứu', 'Mục tiêu nghiên cứu']
                    ],
                    [
                        'type' => 'multiple_choice',
                        'question' => '"興味深い" có nghĩa là gì?',
                        'options' => ['Nhàm chán', 'Thú vị', 'Khó hiểu', 'Dễ hiểu']
                    ],
                    [
                        'type' => 'true_false',
                        'question' => '"今後の" có nghĩa là "trong tương lai"',
                        'options' => []
                    ]
                ],
                'correct_answers' => ['Kết quả nghiên cứu', 'Thú vị', 'true'],
                'points' => 35,
                'is_active' => true
            ]
        ];

        foreach ($exercises as $exercise) {
            ListeningExercise::create($exercise);
        }
    }
}
