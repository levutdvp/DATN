<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Post::create([
            'title' => 'NỘI QUY CHO NGƯỜI DÙNG WEBSITE TRỌ ƠI',
            'metaTitle' => 'Nội Quy',
            'image'=>'https://picsum.photos/200',
            'metaDescription'=>'Nội Quy Cộng Đồng Cho Thuê Trọ',
            'slug'=>'noi-quy',
            'user_id'=>'1',
            'status'=>'active',
            'category_post_id'=>'1',
            'description' => '<p><strong>NỘI QUY CHO CỘNG ĐỒNG THU&Ecirc; TRỌ</strong></p>

<p>Ch&agrave;o mừng bạn đến với trang web thu&ecirc; trọ của ch&uacute;ng t&ocirc;i! Để đảm bảo m&ocirc;i trường an to&agrave;n v&agrave; h&ograve;a đồng cho tất cả th&agrave;nh vi&ecirc;n, ch&uacute;ng t&ocirc;i xin đề xuất một số quy định v&agrave; nguy&ecirc;n tắc cơ bản dưới đ&acirc;y. Vui l&ograve;ng tu&acirc;n theo những quy tắc n&agrave;y v&agrave; thể hiện sự t&ocirc;n trọng v&agrave; sẵn s&agrave;ng hợp t&aacute;c.</p>

<p><strong>1. T&ocirc;n trọng v&agrave; lịch sự:</strong></p>

<ul>
	<li>H&atilde;y lu&ocirc;n t&ocirc;n trọng người kh&aacute;c, bất kể giới t&iacute;nh, t&ocirc;n gi&aacute;o, chủng tộc hoặc quốc gia.</li>
	<li>Tr&aacute;nh sử dụng ng&ocirc;n ngữ th&ocirc; tục, đả k&iacute;ch hoặc ph&acirc;n biệt.</li>
</ul>

<p><strong>2. Đăng tin đ&uacute;ng sự thật:</strong></p>

<ul>
	<li>M&ocirc; tả ch&iacute;nh x&aacute;c v&agrave; r&otilde; r&agrave;ng về ph&ograve;ng trọ, gi&aacute; cả v&agrave; điều kiện thu&ecirc; trọ.</li>
	<li>Kh&ocirc;ng sử dụng th&ocirc;ng tin đ&aacute;nh lừa để thu h&uacute;t người thu&ecirc;.</li>
</ul>

<p><strong>3. Bảo vệ th&ocirc;ng tin c&aacute; nh&acirc;n:</strong></p>

<ul>
	<li>Kh&ocirc;ng chia sẻ th&ocirc;ng tin c&aacute; nh&acirc;n như số điện thoại, địa chỉ email, hoặc địa chỉ nh&agrave; ri&ecirc;ng tư tr&ecirc;n diễn đ&agrave;n c&ocirc;ng khai.</li>
	<li>Lu&ocirc;n giữ th&ocirc;ng tin c&aacute; nh&acirc;n của bạn an to&agrave;n v&agrave; kh&ocirc;ng chia sẻ n&oacute; với người kh&aacute;c nếu kh&ocirc;ng cần thiết.</li>
</ul>

<p><strong>4. Kh&ocirc;ng quảng c&aacute;o kh&ocirc;ng đ&uacute;ng c&aacute;ch:</strong></p>

<ul>
	<li>Kh&ocirc;ng đăng quảng c&aacute;o hoặc spam tr&aacute;i với nội dung của trang web.</li>
	<li>Kh&ocirc;ng sử dụng diễn đ&agrave;n để mua b&aacute;n c&aacute;c sản phẩm hoặc dịch vụ kh&aacute;c ngo&agrave;i thu&ecirc; trọ.</li>
</ul>

<p><strong>5. Giải quyết xung đột một c&aacute;ch t&ocirc;n trọng:</strong></p>

<ul>
	<li>Nếu c&oacute; xung đột hoặc tranh chấp, h&atilde;y thảo luận v&agrave; giải quyết một c&aacute;ch lịch sự v&agrave; x&acirc;y dựng.</li>
	<li>Nếu kh&ocirc;ng thể giải quyết được, h&atilde;y b&aacute;o c&aacute;o cho quản trị vi&ecirc;n.</li>
</ul>

<p><strong>6. Tu&acirc;n thủ c&aacute;c luật v&agrave; quy định:</strong></p>

<ul>
	<li>Tu&acirc;n thủ c&aacute;c quy định ph&aacute;p luật về thu&ecirc; trọ tại địa phương của bạn.</li>
	<li>Kh&ocirc;ng thực hiện c&aacute;c hoạt động phi ph&aacute;p hoặc gian lận.</li>
</ul>

<p><strong>7. Phản hồi x&acirc;y dựng:</strong></p>

<ul>
	<li>Ch&uacute;ng t&ocirc;i đ&aacute;nh gi&aacute; v&agrave; đ&aacute;nh gi&aacute; tất cả c&aacute;c phản hồi của bạn để cải thiện trang web.</li>
	<li>H&atilde;y g&oacute;p &yacute; x&acirc;y dựng v&agrave; thể hiện l&ograve;ng biết ơn đối với sự phản hồi.</li>
</ul>

<p>Nếu bạn kh&ocirc;ng tu&acirc;n thủ c&aacute;c quy định n&agrave;y, ch&uacute;ng t&ocirc;i c&oacute; quyền x&oacute;a tin đăng của bạn hoặc tạm ngừng t&agrave;i khoản của bạn. Ch&uacute;ng t&ocirc;i mong muốn x&acirc;y dựng một cộng đồng th&uacute; vị v&agrave; hữu &iacute;ch cho tất cả người d&ugrave;ng, v&agrave; sự hợp t&aacute;c của bạn l&agrave; rất quan trọng.</p>

<p>Cảm ơn bạn đ&atilde; tham gia cộng đồng thu&ecirc; trọ của ch&uacute;ng t&ocirc;i!</p>'
        ]);
        Post::create([
            'title' => 'GIỚI THIỆU WEBSITE TRỌ ƠI',
            'metaTitle' => 'Trang Giới Thiệu',
            'image'=>'https://picsum.photos/200',
            'metaDescription'=>'Chào mừng bạn đến với Trọ Ơi',
            'slug'=>'gioi-thieu',
            'user_id'=>'1',
            'status'=>'active',
            'category_post_id'=>'1',
            'description' => '<p>Ch&agrave;o mừng bạn đến với Trọ ơi - Nơi bạn t&igrave;m kiếm căn nh&agrave; ấm c&uacute;ng, thoải m&aacute;i v&agrave; ph&ugrave; hợp với nhu cầu của bạn. Ch&uacute;ng t&ocirc;i cam kết mang đến cho bạn trải nghiệm thu&ecirc; trọ tốt nhất, đ&aacute;ng tin cậy v&agrave; dễ d&agrave;ng.</p>

<p><strong>Về Ch&uacute;ng T&ocirc;i</strong></p>

<p>Ch&uacute;ng t&ocirc;i l&agrave; một đội ngũ đam m&ecirc; về bất động sản v&agrave; c&ocirc;ng nghệ, lu&ocirc;n nỗ lực để cung cấp cho bạn sự thuận tiện khi t&igrave;m kiếm nơi ở. <strong>Trọ ơi</strong> được th&agrave;nh lập với mục ti&ecirc;u gi&uacute;p kết nối chủ nh&agrave; c&oacute; căn nh&agrave; trống với những người đang t&igrave;m kiếm một nơi ở. Ch&uacute;ng t&ocirc;i xem trọ l&agrave; nơi bạn bắt đầu một c&acirc;u chuyện mới v&agrave; ch&uacute;ng t&ocirc;i muốn gi&uacute;p bạn tạo ra một chỗ ở m&agrave; bạn c&oacute; thể gọi l&agrave; &quot;nh&agrave;.&quot;</p>

<p><strong>Dịch Vụ Của Ch&uacute;ng T&ocirc;i</strong></p>

<ol>
	<li>
	<p><strong>Thu&ecirc; Trọ Dễ D&agrave;ng</strong>: Với <strong>Trọ ơi</strong>, việc t&igrave;m kiếm nơi ở trở n&ecirc;n dễ d&agrave;ng hơn bao giờ hết. Bạn c&oacute; thể t&igrave;m kiếm căn hộ, ph&ograve;ng trọ, hoặc nh&agrave; ri&ecirc;ng dựa tr&ecirc;n vị tr&iacute;, mức gi&aacute;, v&agrave; tiện &iacute;ch.</p>
	</li>
	<li>
	<p><strong>Đ&aacute;nh Gi&aacute; Từ Người D&ugrave;ng</strong>: Ch&uacute;ng t&ocirc;i hiểu rằng đ&aacute;nh gi&aacute; từ người đ&atilde; từng ở tại một nơi c&oacute; &yacute; nghĩa lớn. Ch&uacute;ng t&ocirc;i cung cấp th&ocirc;ng tin đ&aacute;ng tin cậy về c&aacute;c căn nh&agrave; dựa tr&ecirc;n những đ&aacute;nh gi&aacute; của cộng đồng.</p>
	</li>
	<li>
	<p><strong>Hỗ Trợ 24/7</strong>: Ch&uacute;ng t&ocirc;i lu&ocirc;n sẵn s&agrave;ng hỗ trợ bạn trong qu&aacute; tr&igrave;nh t&igrave;m kiếm, thu&ecirc; v&agrave; ở tại căn nh&agrave; của bạn.</p>
	</li>
</ol>

<p><strong>Lợi &Iacute;ch Khi Sử Dụng</strong>&nbsp;<strong>Trọ ơi</strong></p>

<ul>
	<li>
	<p><strong>Tiết Kiệm Thời Gian</strong>: Kh&ocirc;ng cần lặn lội qua h&agrave;ng trăm trang web hoặc đường phố để t&igrave;m nơi ở ph&ugrave; hợp. Ch&uacute;ng t&ocirc;i tập trung v&agrave;o việc l&agrave;m cho qu&aacute; tr&igrave;nh n&agrave;y nhanh ch&oacute;ng v&agrave; dễ d&agrave;ng.</p>
	</li>
	<li>
	<p><strong>Đ&aacute;ng Tin Cậy</strong>: Ch&uacute;ng t&ocirc;i đảm bảo c&aacute;c th&ocirc;ng tin về căn nh&agrave; v&agrave; chủ nh&agrave; đều được kiểm tra v&agrave; x&aacute;c minh để bạn c&oacute; thể y&ecirc;n t&acirc;m.</p>
	</li>
	<li>
	<p><strong>Đa Dạng Lựa Chọn</strong>: Với h&agrave;ng ng&agrave;n danh s&aacute;ch từ khắp nơi, bạn c&oacute; thể t&igrave;m thấy căn nh&agrave; ph&ugrave; hợp với mọi ng&acirc;n s&aacute;ch v&agrave; nhu cầu.</p>
	</li>
</ul>

<p><strong>Li&ecirc;n Hệ Với Ch&uacute;ng T&ocirc;i</strong></p>

<p>H&atilde;y li&ecirc;n hệ với ch&uacute;ng t&ocirc;i qua <a href="https://www.facebook.com/phuc.quang.50103">Admin</a> , hoặc theo d&otilde;i ch&uacute;ng t&ocirc;i tr&ecirc;n c&aacute;c trang mạng x&atilde; hội để cập nhật th&ocirc;ng tin mới nhất về bất động sản v&agrave; thu&ecirc; trọ.</p>

<p>[Th&ecirc;m th&ocirc;ng tin li&ecirc;n hệ v&agrave; mạng x&atilde; hội]</p>

<p><strong>Trọ ơi</strong> - Nơi bạn bắt đầu một c&acirc;u chuyện mới v&agrave; t&igrave;m thấy &quot;nh&agrave;&quot; của m&igrave;nh. H&atilde;y tham gia c&ugrave;ng ch&uacute;ng t&ocirc;i ngay h&ocirc;m nay để kh&aacute;m ph&aacute; thế giới của c&aacute;c căn nh&agrave; đang chờ bạn.</p>'
        ]);
    }

}
