@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <ol>
                <li><strong>B&agrave;i to&aacute;n (bối cảnh)</strong>
                    <ul>
                        <li>
                            <p>Ng&agrave;y nay c&ocirc;ng việc, học tập chỉ l&agrave; một trong c&aacute;c nguy&ecirc;n
                                nh&acirc;n ch&iacute;nh g&acirc;y &aacute;p lực l&ecirc;n tinh thần giới trẻ v&agrave;
                                &aacute;p lực của họ n&agrave;y cần được giải ph&oacute;ng, ngo&agrave;i việc chơi game, xem
                                phim th&igrave; đọc tiểu thuyết cũng l&agrave; một trong c&aacute;c c&aacute;ch hữu hiệu để
                                giải tr&iacute;. Trước kia c&aacute;c tờ b&aacute;o giấy khổ lớn hay c&aacute;c quyển
                                truyện, tiểu thuyết được xuất bản với gi&aacute; th&agrave;nh cao g&acirc;y kh&oacute; tiếp
                                cận với người đọc v&agrave; rồi khi m&agrave; b&aacute;o điện tử, E-Book, tiểu thuyết mạng
                                ra đời đ&atilde; giải quyết vấn đề n&agrave;y.</p>
                        </li>
                        <li>
                            <p>C&aacute;c khảo s&aacute;t chỉ ra l&agrave; độc giả của tiểu thuyết mạng phần lớn l&agrave;
                                giới trẻ hay thế hệ Gen Z &ldquo;Theo khảo s&aacute;t hồi th&aacute;ng 7/2022 của nền tảng
                                đọc s&aacute;ch di động Wattpad, phần lớn độc giả trong độ tuổi 18-24, 80% người d&ugrave;ng
                                trung th&agrave;nh của ứng dụng thuộc Gen Z. Đ&aacute;ng n&oacute;i, tổng thời gian đọc mỗi
                                th&aacute;ng của nh&oacute;m n&agrave;y l&ecirc;n đến 23 tỷ ph&uacute;t.&rdquo; Họ ưa
                                th&iacute;ch những g&igrave; tiện lợi, nhanh ch&oacute;ng, chi ph&iacute; thấp vậy n&ecirc;n
                                tiểu thuyết mạng hay E-Book đang dần được ưa chuộng hơn so với bản giấy. Th&ecirc;m nữa
                                &ldquo;xu hướng giải tr&iacute; ng&agrave;y nay lại c&agrave;ng thi&ecirc;n hướng về giải
                                tr&iacute; tại chỗ, họ lười vận động, c&oacute; xu hướng sống về đ&ecirc;m v&agrave; phụ
                                thuộc v&agrave;o thiết bị điện tử&rdquo;.</p>
                        </li>
                        <li>
                            <p>Thị trường c&agrave;ng c&oacute; tiềm năng hơn khi m&agrave; vấn đề an ninh mạng, Internet
                                sạch cũng như vấn đề bản quyền sở hữu tr&iacute; tuệ c&agrave;ng ng&agrave;y c&agrave;ng
                                được coi trọng khi m&agrave; thiếu đi sự thẩm định của c&aacute;c cơ quan trước khi
                                c&aacute;c ấn phẩm được xuất bản. Điển h&igrave;nh như rất nhiều web đọc truyện lậu kiếm
                                tiền bằng việc đăng tải c&aacute;c t&aacute;c phẩm m&agrave; chưa được sự đồng &yacute; của
                                ph&iacute;a t&aacute;c giả hay nh&agrave; ph&acirc;n phối đang bị kiểm tra v&agrave; chặn
                                t&ecirc;n miền do vấn đề bản bản quyền.</p>
                        </li>
                        <li>
                            <p>=&gt; V&igrave; vậy việc x&acirc;y dựng một website đọc tiểu thuyết trực tuyến đảm bảo
                                c&aacute;c yếu tố về bản quyền, giải tr&iacute;, tiện lợi l&agrave; một dự &aacute;n tiềm
                                năng.</p>

                            <p>Tiểu thuyết mạng, tiểu thuyết tr&ecirc;n web hay web novel (WN), l&agrave; những t&aacute;c
                                phẩm văn học được viết chủ yếu tr&ecirc;n internet. Văn học mạng thường được đăng tải
                                d&agrave;i kỳ tr&ecirc;n c&aacute;c nền tảng trực tuyến, gọi l&agrave; &quot;tiểu thuyết
                                mạng li&ecirc;n tải&quot; (webserial). Thuật ngữ n&agrave;y bắt nguồn từ c&aacute;c
                                t&aacute;c phẩm truyện li&ecirc;n tải (serial) được xuất bản d&agrave;i kỳ tr&ecirc;n
                                b&aacute;o v&agrave; tạp ch&iacute;</p>
                        </li>
                        <li>
                            <p>&ldquo;V&iacute; dụ, độ d&agrave;i của một cuốn tiểu thuyết d&agrave;nh cho giới trẻ dao động
                                từ 50.000 đến 75.000 từ. Hầu hết c&aacute;c chuy&ecirc;n gia đều đồng &yacute; rằng một
                                nguy&ecirc;n tắc chung để tu&acirc;n theo l&agrave; 2.500 - 5.000 từ mỗi chương. Do
                                đ&oacute;, điểm khởi đầu hợp l&yacute; cho một cuốn tiểu thuyết d&agrave;nh cho giới trẻ sẽ
                                l&agrave; từ 10 đến 26 chương.&rdquo;</p>
                        </li>
                        <li>
                            <p>Kh&ocirc;ng giống s&aacute;ch, một t&aacute;c phẩm văn học mạng thường kh&ocirc;ng được
                                bi&ecirc;n soạn v&agrave; xuất bản to&agrave;n bộ. Thay v&agrave;o đ&oacute;, n&oacute; được
                                t&aacute;c giả ra mắt tr&ecirc;n Internet mỗi khi viết xong từng phần hoặc từng chương,
                                trong khi kh&ocirc;ng c&oacute; kế hoạch hay thời điểm cụ thể để ra mắt to&agrave;n bộ. Tiểu
                                thuyết mạng li&ecirc;n tải l&agrave; h&igrave;nh thức viết chủ đạo trong giới fan fiction.
                            </p>
                        </li>
                    </ul>
                </li>
                <li><strong>Đề t&agrave;i</strong>
                    <ul>
                        <li>
                            <p>Đề t&agrave;i X&acirc;y dựng v&agrave; kiểm thử website đọc tiểu thuyết NovelBook thuộc lĩnh
                                vực c&ocirc;ng nghệ th&ocirc;ng tin, giải quyết b&agrave;i to&aacute;n giải tr&iacute; bằng
                                tiểu thuyết mạng. Đ&acirc;y l&agrave; một b&agrave;i to&aacute;n thực tế, phổ biến trong đời
                                sống với nhu cầu chất lượng cuộc sống ng&agrave;y c&agrave;ng cao ng&agrave;y nay văn
                                h&oacute;a đọc được tiếp nhận nhưng cộng đồng c&ograve;n thiếu &yacute; thức về bản quyền
                                v&agrave; việc trả ph&iacute; cho n&oacute;.</p>
                        </li>
                        <li>
                            <p>Ngo&agrave;i ra c&ograve;n c&oacute; c&aacute;c vấn đề về kiểm duyệt nội dung, vấn đề về an
                                to&agrave;n bảo mật khi truy cập c&aacute;c web lậu, việc trả ph&iacute; cho c&aacute;c
                                t&aacute;c giả đ&atilde; đăng tải sản phẩm của ch&iacute;nh m&igrave;nh s&aacute;ng
                                t&aacute;c cũng chưa được coi trọng. Tổng hợp c&aacute;c l&yacute; do tr&ecirc;n v&agrave;
                                bối cảnh cũng như tiềm năng thị trường nh&oacute;m em quyết định thực hiện đề t&agrave;i
                                X&acirc;y dựng v&agrave; kiểm thử website đọc tiểu thuyết NovelBook.</p>
                        </li>
                    </ul>
                </li>
                <li><strong>Phạm vi nghi&ecirc;n cứu.</strong>
                    <ul>
                        <li>Nh&oacute;m người sử dụng hướng đến của đề t&agrave;i l&agrave; giới trẻ trong độ tuổi 18-28
                            tuổi.</li>
                        <li>Sản phẩm m&agrave; website cung cấp l&agrave; đa dạng c&aacute;c thể loại tiểu thuyết.</li>
                        <li>Cung cấp dịch vụ đọc tiểu thuyết trực tuyến (web novel).</li>
                        <li>Đề t&agrave;i c&oacute; thời hạn l&agrave; 12 tuần kể từ 20/5/2024.</li>
                    </ul>
                </li>
                <li><strong>Lợi &iacute;ch.</strong>
                    <ul>
                        <li><strong>Độc giả.</strong>
                            <ul>
                                <li>Tiếp cận với nguồn tiểu thuyết phong ph&uacute;.</li>
                                <li>Nắm bắt được xu hướng kịp thời với c&aacute;c thể loại m&agrave; m&igrave;nh y&ecirc;u
                                    th&iacute;ch.</li>
                                <li>Thực hiện ti&ecirc;u d&ugrave;ng th&ocirc;ng minh khi mua c&aacute;c bản điện tử của
                                    tiểu thuyết, kh&ocirc;ng c&oacute; lo lắng về bảo quản cũng như tiện lợi khi kh&ocirc;ng
                                    cần lu&ocirc;n mang b&ecirc;n cạnh một bản giấy.</li>
                            </ul>
                        </li>
                        <li><strong>T&aacute;c giả.</strong>
                            <ul>
                                <li>Đa dạng nguồn thu nhập từ việc đăng tải truyện do m&igrave;nh s&aacute;ng t&aacute;c.
                                </li>
                                <li>Kết nối với độc giả qua c&aacute;c &yacute; kiến, b&igrave;nh luận phản hồi của độc giả
                                    từ đ&oacute; ph&aacute;t triển, cải thiện khả năng s&aacute;ng t&aacute;c bản
                                    th&acirc;n.</li>
                            </ul>
                        </li>
                        <li><strong>X&atilde; hội.</strong>
                            <ul>
                                <li>&nbsp;</li>
                                <li>Tăng cường gi&aacute;o dục trong tu&acirc;n thủ ph&aacute;p luật t&ocirc;n trọng bản
                                    quyền v&agrave; n&acirc;ng cao &yacute; thức cộng đồng về ph&iacute; bản quyền.</li>
                                <li>Tăng cường tương t&aacute;c v&agrave; gắn kết cộng đồng y&ecirc;u th&iacute;ch tiểu
                                    thuyết.</li>
                                <li>L&agrave;m sạch, tăng cường an to&agrave;n internet với c&aacute;c t&aacute;c phẩm được
                                    kiểm duyệt kỹ c&agrave;ng, loại bỏ c&aacute;c nội dung độc hại v&agrave; cải thiện
                                    t&iacute;nh an to&agrave;n th&ocirc;ng tin c&aacute; nh&acirc;n của người d&ugrave;ng.
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ol>

        </div>

    </div>
@endsection
