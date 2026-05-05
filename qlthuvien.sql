-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 05, 2026 lúc 07:15 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlthuvien`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `authors`
--

CREATE TABLE `authors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `authors`
--

INSERT INTO `authors` (`id`, `name`, `bio`, `created_at`, `updated_at`) VALUES
(1, 'Yuval Noah Harari', 'Học vấn và Sự nghiệp: Harari nhận bằng Tiến sĩ từ Đại học Oxford năm 2002. Ông hiện là giảng viên tại Khoa Lịch sử thuộc Đại học Hebrew Jerusalem và là nghiên cứu viên tại Trung tâm Nghiên cứu Rủi ro Hiện sinh, Đại học Cambridge.\r\nTác phẩm nổi bật: Các sách của ông đã bán được hơn 40 triệu bản bằng 65 ngôn ngữ, bao gồm:\r\nSapiens: Lược sử loài người (2014): Khảo sát lịch sử loài người từ thời đồ đá đến hiện tại.\r\nHomo Deus: Lược sử tương lai (2016): Thảo luận về viễn cảnh tương lai khi con người trở thành thần thánh nhờ công nghệ.\r\n21 bài học cho thế kỷ 21 (2018): Tập trung vào các vấn đề cấp bách hiện nay.\r\nNexus (2024): Bàn về trí tuệ nhân tạo (AI) và các mối đe dọa hiện sinh.\r\nQuan điểm và Ảnh hưởng: Ông được coi là một trong những nhà trí thức công cộng có ảnh hưởng nhất thế giới hiện nay, thường xuyên cảnh báo về tác động của AI đối với xã hội.\r\nGiải thưởng: Hai lần giành giải thưởng Polonsky cho \"Sáng tạo và độc đáo\" vào năm 2009 và 2012.', '2026-04-26 23:30:48', '2026-04-26 23:30:48'),
(2, 'Rosie Nguyễn', 'Rosie Nguyễn tên thật là Nguyễn Hoàng Nguyên, một tác giả sách, blogger/facebooker về văn hóa du lịch, giảng viên lớp học kỹ năng, và huấn luyện viên yoga. Ngoài việc viết lách và giảng dạy, Rosie còn là một người tự học, một ta ba lô, một kẻ mộng mơ và tràn đầy tình yêu cuộc sống.', '2026-04-26 23:31:13', '2026-04-26 23:31:13'),
(3, 'Victor Hugo', 'Victor Hugo chiếm một vị trí trang trọng trong lịch sử văn học Pháp. Các tác phẩm của ông đa dạng về thể loại và trải rộng trên nhiều lĩnh vực khác nhau. Với tư cách là nhà thơ trữ tình, Hugo đã xuất bản tập Odes et Ballades (1826), Les feuilles d\'automne (1831) hay Les Contemplations (1856). Nhưng ông cũng thể hiện vai trò của một nhà thơ dấn thân chống Napoléon III bằng tập thơ Les Châtiments (1853) và vai trò một nhà sử thi với tập La Légende des siècles (1859 và 1877). Thành công vang dội của hai tác phẩm Nhà thờ Đức Bà Paris và Những người khốn khổ đã đưa Victor Hugo trở thành tiểu thuyết gia của công chúng. Về kịch, ông đã trình bày thuyết kịch lãng mạn trong bài tựa của vở kịch Cromwell (1827) và minh họa rõ nét thể loại này ở hai vở kịch nổi tiếng Hernani (1830) và Ruy Blas (1838).', '2026-04-26 23:31:57', '2026-04-26 23:31:57'),
(4, 'Andrea Hirata', 'Tác giả: Andrea Hirata (sinh năm 1967 tại đảo Belitung, Indonesia).\r\nTác phẩm: Chiến binh cầu vồng là cuốn tiểu thuyết đầu tay của ông, xuất bản năm 2005, dựa trên những trải nghiệm thời thơ ấu có thật của chính tác giả.\r\nNội dung: Cuốn sách kể về cuộc sống của 10 đứa trẻ nghèo ở đảo Belitung và hành trình học tập đầy gian khổ, kiên trì tại ngôi trường làng Muhammadiyah thiếu thốn, qua đó tôn vinh sức mạnh của giáo dục và ước mơ.\r\nTên gọi: \"Chiến binh cầu vồng\" là tên gọi do cô giáo Mus đặt cho nhóm học sinh này.', '2026-04-26 23:34:01', '2026-04-26 23:34:01'),
(5, 'Dale Carnegie', 'Dale Carnegie (1888–1955) là một nhà văn, diễn giả nổi tiếng người Mỹ và là bậc thầy trong lĩnh vực phát triển bản thân, kỹ năng giao tiếp, nghệ thuật bán hàng và nói trước công chúng. Ông nổi tiếng nhất với tác phẩm kinh điển \"Đắc Nhân Tâm\" (How to Win Friends and Influence People), thay đổi cách nhìn nhận về phát triển cá nhân của hàng triệu người', '2026-04-26 23:34:42', '2026-04-26 23:34:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('available','unavailable') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `publisher_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `books`
--

INSERT INTO `books` (`id`, `name`, `slug`, `author`, `price`, `description`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`, `publisher_id`) VALUES
(1, 'Sách Mẫu 1', 'sach-mau-1', 'Tác Giả 1', 10000.00, 'Một cuốn sách mẫu', NULL, 'available', '2026-04-09 02:04:03', '2026-04-09 02:10:10', '2026-04-09 02:10:10', NULL),
(2, 'Sách Mẫu 2', 'sach-mau-2', 'Tác Giả 2', 15000.00, 'Một cuốn sách mẫu khác', NULL, 'available', '2026-04-09 02:04:03', '2026-04-09 02:05:45', '2026-04-09 02:05:45', NULL),
(3, 'Đắc Nhân Tâm', 'dac-nhan-tam', 'Dale Carnegie', 99999.00, 'Đắc Nhân Tâm\" (tựa gốc: How to Win Friends and Influence People) được xuất bản lần đầu vào năm 1936, nhưng đến nay vẫn giữ nguyên giá trị vượt thời gian. Cuốn sách được chia thành nhiều phần, mỗi phần là một bài học nhỏ giúp bạn hiểu rõ hơn về tâm lý con người và cách ứng xử sao cho hiệu quả. Điều mình thích nhất ở cuốn sách này là cách viết cực kỳ dễ hiểu và gần gũi. Tác giả Dale Carnegie không dùng những lý thuyết khô khan, mà thay vào đó là những câu chuyện thực tế, ví dụ đời thường khiến mình cảm thấy như đang trò chuyện với một người bạn.', 'books/MtqlDi4Bsplcsf3Ezd04s4VN4DADDcDsLfPFB3FF.jpg', 'available', '2026-04-09 02:10:05', '2026-04-18 23:37:56', NULL, NULL),
(4, 'Nhà Giả Kim', 'nha-gia-kim', 'Paulo Coelho', 99999.00, '“Nhà Giả Kim” là một tiểu thuyết nổi tiếng của nhà văn Paulo Coelho, kể về hành trình phiêu lưu đầy cảm hứng của cậu bé chăn cừu Santiago đến từ Tây Ban Nha. Trong một giấc mơ lặp đi lặp lại, cậu được mách bảo rằng kho báu đang chờ đợi mình ở Ai Cập, gần kim tự tháp. Với niềm tin mãnh liệt vào giấc mơ và khát vọng theo đuổi vận mệnh cá nhân, Santiago lên đường đi qua sa mạc, trải nghiệm những khó khăn, thử thách và cả những cuộc gặp gỡ có ý nghĩa sâu sắc.\r\n\r\nCuốn sách không chỉ là một câu chuyện phiêu lưu mà còn là một hành trình tìm kiếm ý nghĩa cuộc sống. Qua từng nhân vật và chi tiết biểu tượng, “Nhà Giả Kim” truyền tải thông điệp về việc lắng nghe trái tim, theo đuổi ước mơ và tin vào dấu hiệu của vũ trụ. Với văn phong giản dị, sâu sắc, tác phẩm đã trở thành nguồn cảm hứng cho hàng triệu độc giả trên toàn thế giới.', 'books/wkIxJnxGF7QTW54a7sVDCecurpE4yV8M2rAUv6qC.jpg', 'available', '2026-04-11 03:05:22', '2026-04-18 23:38:07', NULL, NULL),
(5, 'Đi Tìm Lẽ Sống', 'di-tim-le-song', 'Viktor E. Frankl', 87900.00, '“Đi Tìm Lẽ Sống” là một cuốn sách nổi tiếng của Viktor E. Frankl, bác sĩ tâm thần học người Áo, kể lại những trải nghiệm của ông trong các trại tập trung của Đức Quốc xã trong Thế chiến thứ hai. Không chỉ là một bản ghi chép về nỗi đau thể xác và tinh thần, cuốn sách còn là hành trình sâu sắc đi tìm ý nghĩa sống giữa những hoàn cảnh khắc nghiệt nhất mà con người có thể đối mặt.\r\n\r\nQua trải nghiệm cá nhân, Frankl phát triển liệu pháp ý nghĩa (logotherapy), với niềm tin rằng điều khiến con người có thể vượt qua đau khổ không phải là sự tránh né khổ đau, mà là tìm được ý nghĩa trong nó. Cuốn sách không mang nặng tính học thuật mà gần gũi, chân thật và đầy tính nhân văn, để lại nhiều suy ngẫm cho những ai đang đi tìm câu trả lời cho mục đích và giá trị sống của mình.', 'books/On4qvsh5Z7uIxptK69uwcFHfltEiNifZoiBWwiQV.jpg', 'unavailable', '2026-04-11 03:08:40', '2026-04-18 23:38:18', NULL, NULL),
(6, 'Giết Con Chim Nhại', 'giet-con-chim-nhai', 'Harper Lee', 100000.00, '“Giết Con Chim Nhại” của Harper Lee là một tác phẩm văn học kinh điển, kể về tuổi thơ của cô bé Scout Finch tại thị trấn nhỏ miền Nam nước Mỹ trong những năm 1930. Thông qua con mắt ngây thơ của Scout, cuốn sách khắc họa sâu sắc những bất công trong xã hội, đặc biệt là nạn phân biệt chủng tộc, khi người cha của cô – luật sư Atticus Finch – đứng ra bào chữa cho một người đàn ông da đen bị buộc tội oan.\r\n\r\nDù là một câu chuyện về tuổi thơ, “Giết Con Chim Nhại” lại chứa đựng những thông điệp sâu xa về công lý, lòng dũng cảm và sự tử tế. Cuốn sách vừa dịu dàng, vừa đau đáu, để lại trong lòng người đọc những suy ngẫm về cách con người đối xử với nhau và tầm quan trọng của việc giữ vững lương tri giữa một xã hội đầy định kiến.', 'books/7lKFzeU2dRUv5AWniiN9TTIp2tB0uB77OjTPsxEv.png', 'available', '2026-04-11 03:14:54', '2026-04-11 03:14:54', NULL, NULL),
(7, 'Bố già', 'bo-gia', 'Mario Puzo', 100000.00, '\"Bố già\" là tiểu thuyết kinh điển về thế giới ngầm mafia Ý ở Mỹ. Mario Puzo xây dựng một câu chuyện hấp dẫn xoay quanh gia đình Corleone và đế chế tội phạm của họ. Cuốn sách không chỉ gay cấn mà còn chứa đựng những bài học sâu sắc về quyền lực, lòng trung thành và gia đình. \"Bố già\" là tác phẩm kinh điển đáng đọc cho mọi độc giả.', 'books/TFR93FGWXcwKPG8qgxgKFMumJ5x0btUjVj1XvwtF.jpg', 'available', '2026-04-18 00:58:03', '2026-04-18 00:58:03', NULL, NULL),
(8, 'Hoàng Tử Bé', 'hoang-tu-be', 'Antoine de Saint-Exupéry', 200000.00, '“Hoàng Tử Bé” là một tác phẩm nổi tiếng của nhà văn người Pháp Antoine de Saint-Exupéry, kể về cuộc gặp gỡ kỳ lạ giữa một phi công bị rơi máy bay giữa sa mạc và một cậu bé đến từ một hành tinh xa xôi. Trong những ngày ở sa mạc, cậu bé – Hoàng Tử Bé – đã kể cho người phi công nghe về hành trình của mình qua các hành tinh khác nhau, nơi cậu gặp gỡ nhiều người lớn với những cách sống và suy nghĩ rất “người lớn”\r\nẨn sau câu chuyện tưởng như dành cho thiếu nhi là những triết lý sâu sắc về tình yêu, tình bạn, sự cô đơn và ý nghĩa cuộc sống. “Hoàng Tử Bé” chạm đến trái tim người đọc bởi sự hồn nhiên, giản dị nhưng đầy sâu sắc, nhắc nhở chúng ta về giá trị của những điều vô hình và tầm quan trọng của việc nhìn thế giới bằng trái tim thay vì chỉ bằng lý trí.', 'books/lwYDIc0xcsGbx2I9C5z1fFARrSdeFcewTJjsbIba.jpg', 'available', '2026-04-26 21:48:02', '2026-04-26 21:48:02', NULL, NULL),
(9, 'Sapiens: Lược Sử Loài Người', 'sapiens-luoc-su-loai-nguoi', 'Yuval Noah Harari', 150000.00, '“Sapiens: Lược Sử Loài Người” là một cuốn sách phi hư cấu nổi bật của Yuval Noah Harari, kể lại hành trình tiến hóa và phát triển của loài người từ thời tiền sử đến xã hội hiện đại. Với cách tiếp cận mới mẻ và dễ hiểu, tác giả dẫn dắt người đọc qua ba cuộc cách mạng lớn – Cách mạng Nhận thức, Cách mạng Nông nghiệp và Cách mạng Khoa học – để lý giải vì sao loài Homo sapiens, vốn chỉ là một trong nhiều loài người, lại trở thành giống loài thống trị Trái Đất.\r\n\r\nCuốn sách không chỉ đơn thuần là một bản tóm lược lịch sử, mà còn đặt ra nhiều câu hỏi lớn về bản chất của con người, xã hội, tôn giáo, tiền bạc và hạnh phúc. Harari kết hợp giữa lịch sử, sinh học và triết học để giúp người đọc nhìn lại quá khứ một cách sâu sắc, đồng thời suy ngẫm về hiện tại và tương lai của chính mình trong bức tranh rộng lớn của nhân loại.', 'books/S7cyQTnst7yq6rJtg7cLdorkihewyPkRhR7zVR2i.jpg', 'available', '2026-04-26 21:51:12', '2026-04-26 23:27:40', NULL, 4),
(10, 'Tuổi Trẻ Đáng Giá Bao Nhiêu', 'tuoi-tre-dang-gia-bao-nhieu', 'Rosie Nguyễn', 300000.00, '“Tuổi Trẻ Đáng Giá Bao Nhiêu” là cuốn sách truyền cảm hứng của tác giả Rosie Nguyễn, dành cho những người trẻ đang loay hoay tìm kiếm hướng đi trong cuộc sống. Bằng giọng văn gần gũi và chân thành, tác giả chia sẻ những trải nghiệm thực tế của bản thân trong học tập, làm việc, du lịch và phát triển bản thân, từ đó gửi gắm thông điệp về việc sống hết mình với tuổi trẻ, dám mơ ước và hành động để theo đuổi đam mê.\r\n\r\nCuốn sách không đưa ra lời khuyên cứng nhắc mà nhẹ nhàng định hướng, giúp người đọc hiểu rằng tuổi trẻ là khoảng thời gian quý giá để thử sai, để học hỏi và trưởng thành. Với những chia sẻ chân thực và sâu sắc, “Tuổi Trẻ Đáng Giá Bao Nhiêu” đã trở thành người bạn đồng hành tin cậy của rất nhiều bạn trẻ trên hành trình tìm kiếm chính mình.', 'books/PGE8sZi3apepMDNwWdPg63cdfQ3CzQzC6kD3aRKM.jpg', 'available', '2026-04-26 21:53:30', '2026-04-26 23:23:18', NULL, 1),
(11, 'Những Người Khốn Khổ', 'nhung-nguoi-khon-kho', 'Victor Hugo', 230000.00, '“Những Người Khốn Khổ” là kiệt tác văn học của Victor Hugo, kể về cuộc đời đầy biến động của Jean Valjean – một người từng bị kết án vì ăn cắp bánh mì và sau đó bị xã hội ruồng bỏ dù đã cải tà quy chính. Trên hành trình đi tìm lại lẽ sống và lòng nhân ái, ông gặp gỡ nhiều nhân vật khác như Fantine, Cosette, Marius và cả thanh tra Javert – người luôn theo đuổi ông với niềm tin cứng nhắc vào công lý.\r\n\r\nBằng cốt truyện sâu sắc và đầy tính nhân văn, tác phẩm không chỉ phản ánh sự bất công và khoảng cách giàu nghèo trong xã hội Pháp thế kỷ 19, mà còn khắc họa một cách cảm động sức mạnh của lòng vị tha, tình yêu và niềm tin vào con người. “Những Người Khốn Khổ” là một bản anh hùng ca về con người trong nghịch cảnh, khiến người đọc xúc động và suy ngẫm về giá trị đích thực của lòng nhân đạo.', 'books/vW2fkijQYccUl3rNTm2YoPoF6xgoghYoHYNczFAc.jpg', 'unavailable', '2026-04-26 21:55:29', '2026-05-05 09:56:57', NULL, 3),
(12, 'Cà Phê Cùng Tony', 'ca-phe-cung-tony', 'tác giả ẩn danh mang bút danh Tony Buổi Sáng', 123000.00, '“Cà Phê Cùng Tony” là tập hợp những bài viết truyền cảm hứng được chia sẻ từ Facebook cá nhân của tác giả ẩn danh mang bút danh Tony Buổi Sáng. Bằng lối kể chuyện dí dỏm, gần gũi và đầy chất đời, cuốn sách mang đến cho người đọc những bài học thực tế về kỹ năng sống, tinh thần cầu tiến, trách nhiệm và khát vọng vươn ra thế giới, đặc biệt dành cho người trẻ Việt Nam trong thời kỳ hội nhập.\r\n\r\nThông qua những câu chuyện thường ngày nhưng sâu sắc, từ chuyện học hành, đi làm đến cách cư xử trong xã hội, “Cà Phê Cùng Tony” không chỉ giải trí mà còn khơi dậy trong người đọc tinh thần tự học, tinh thần khởi nghiệp và sống tử tế. Cuốn sách như một ly cà phê đậm đà, vừa nhẹ nhàng vừa thức tỉnh, truyền động lực để mỗi người trẻ sống chủ động và không ngừng hoàn thiện bản thân.', 'books/kPlqBIDudYT1XKG3QtU98fKhFnnSeqpzW91YpGti.jpg', 'available', '2026-04-26 22:00:59', '2026-04-26 23:18:10', NULL, 2),
(13, 'Chiến Binh Cầu Vồng', 'chien-binh-cau-vong', 'Rainie Le', 130000.00, '“Chiến Binh Cầu Vồng” của tác giả Rainie Le là một cuốn sách truyền cảm hứng mạnh mẽ về hành trình vượt qua những khó khăn trong cuộc sống và khẳng định bản thân. Cuốn sách kể về câu chuyện của một cô gái trẻ, qua những thử thách và gian nan, đã học được cách tìm kiếm niềm vui, sự mạnh mẽ từ bên trong và làm chủ cuộc sống của chính mình. Cô không chỉ đối mặt với những khó khăn bên ngoài mà còn phải chiến đấu với chính bản thân để tìm ra lý do sống và ước mơ.\r\n\r\nThông qua những câu chuyện đầy cảm động và sâu sắc, “Chiến Binh Cầu Vồng” mang đến thông điệp về sự kiên cường, lòng dũng cảm và khả năng làm chủ cuộc đời dù hoàn cảnh có khó khăn đến đâu. Cuốn sách là nguồn động lực cho những ai đang tìm kiếm sự thay đổi trong cuộc sống và muốn vươn lên từ những thử thách để trở thành phiên bản tốt nhất của chính mình', 'books/c70tY5dyOqTWDoZdoAjvoZpAlHTY006TA4MtcLqm.jpg', 'available', '2026-04-26 22:25:59', '2026-04-26 23:17:55', NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `book_category`
--

CREATE TABLE `book_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `book_category`
--

INSERT INTO `book_category` (`id`, `book_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 3, NULL, NULL),
(3, 2, 2, NULL, NULL),
(4, 2, 4, NULL, NULL),
(5, 3, 1, NULL, NULL),
(6, 3, 7, NULL, NULL),
(7, 4, 1, NULL, NULL),
(8, 4, 7, NULL, NULL),
(9, 5, 7, NULL, NULL),
(10, 6, 1, NULL, NULL),
(11, 6, 7, NULL, NULL),
(12, 7, 1, NULL, NULL),
(13, 7, 8, NULL, NULL),
(14, 8, 1, NULL, NULL),
(15, 8, 8, NULL, NULL),
(16, 9, 8, NULL, NULL),
(17, 9, 9, NULL, NULL),
(18, 10, 1, NULL, NULL),
(19, 10, 7, NULL, NULL),
(20, 11, 7, NULL, NULL),
(21, 11, 8, NULL, NULL),
(22, 12, 1, NULL, NULL),
(23, 12, 7, NULL, NULL),
(24, 13, 4, NULL, NULL),
(25, 13, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `borrows`
--

CREATE TABLE `borrows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `reader_id` bigint(20) UNSIGNED NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` enum('borrowed','returned') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `borrows`
--

INSERT INTO `borrows` (`id`, `book_id`, `reader_id`, `borrow_date`, `return_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 1, '2026-04-01', '2026-04-11', 'borrowed', '2026-04-11 03:16:24', '2026-04-11 03:16:24'),
(3, 7, 3, '2026-02-11', '2026-05-05', 'returned', '2026-04-18 23:36:29', '2026-05-05 09:57:10'),
(4, 11, 4, '2026-05-05', '2026-07-10', 'borrowed', '2026-05-05 09:56:57', '2026-05-05 09:56:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `book_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 5, 12, 1, '2026-05-05 09:44:57', '2026-05-05 09:44:57'),
(2, 5, 11, 1, '2026-05-05 09:50:21', '2026-05-05 09:50:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Văn Học', 'Sách văn học', '2026-04-09 02:04:03', '2026-04-09 02:04:03'),
(2, 'Khoa Học', 'Sách khoa học', '2026-04-09 02:04:03', '2026-04-09 02:04:03'),
(3, 'Hành Động', 'Sách hành động', '2026-04-09 02:04:03', '2026-04-09 02:04:03'),
(4, 'Tình Cảm', 'Sách tình cảm', '2026-04-09 02:04:03', '2026-04-09 02:04:03'),
(5, 'Trinh Thám', 'Sách trinh thám', '2026-04-09 02:04:03', '2026-04-09 02:04:03'),
(6, 'Kinh Dị', 'Sách kinh dị', '2026-04-09 02:04:03', '2026-04-09 02:04:03'),
(7, 'Tâm Lý', 'Sách tâm lý', '2026-04-09 02:04:03', '2026-04-09 02:04:03'),
(8, 'Tiểu Thuyết', 'Sách tiểu thuyết', '2026-04-18 00:58:53', '2026-04-18 00:58:53'),
(9, 'Viễn Tưởng', 'Sách viễn tưởng', '2026-04-26 21:48:58', '2026-04-26 21:48:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_09_071422_create_categories_table', 1),
(5, '2026_04_09_071504_create_books_table', 1),
(6, '2026_04_09_071537_create_readers_table', 1),
(7, '2026_04_09_071602_create_borrows_table', 1),
(8, '2026_04_09_090141_create_book_category_table', 1),
(9, '2026_04_09_090203_remove_category_id_from_books_table', 1),
(10, '2026_04_18_000000_add_google_id_to_users_table', 1),
(11, '2026_04_18_080740_add_role_to_users_table', 1),
(12, '2026_04_19_000001_create_payments_table', 1),
(13, '2026_04_27_054230_create_authors_table', 1),
(14, '2026_04_27_054230_create_publishers_table', 1),
(15, '2026_04_27_054231_create_reviews_table', 1),
(16, '2026_04_27_054231_create_shelves_table', 1),
(17, '2026_04_27_061139_add_publisher_id_to_books_table', 1),
(18, '2026_04_29_034741_add_columns_to_reviews_table', 1),
(19, '2026_05_02_160225_add_avatar_and_phone_to_users_table', 2),
(20, '2026_05_05_153023_create_carts_table', 2),
(21, '2026_05_05_162837_update_role_enum_in_users_table', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `borrow_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` enum('purchase','borrow') NOT NULL,
  `borrow_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL DEFAULT 'cash',
  `payment_status` enum('pending','paid','cancelled') NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `admin_note` text DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `book_id`, `borrow_id`, `type`, `borrow_date`, `return_date`, `amount`, `payment_method`, `payment_status`, `notes`, `admin_note`, `paid_at`, `created_at`, `updated_at`) VALUES
(4, 5, 11, 4, 'borrow', '2026-05-05', '2026-07-10', 34500.00, 'bank_transfer', 'paid', NULL, NULL, '2026-05-05 09:56:57', '2026-05-05 09:50:54', '2026-05-05 09:56:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `publishers`
--

CREATE TABLE `publishers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `publishers`
--

INSERT INTO `publishers` (`id`, `name`, `address`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'NXB Hội Nhà Văn', 'Địa chỉ: Số 65 Nguyễn Du, Phường Hai Bà Trưng, Hà Nộ', 'lienhe@nxbhoinhavan.vn', '(024) 3822 2135', '2026-04-26 23:01:37', '2026-04-26 23:01:37'),
(2, 'NXB Trẻ', 'Số 21, Dãy A11, Khu Đầm Trấu, Phường Hồng Hà, Hà Nội', 'chinhanhhanoi@nxbtre.com.vn', '(024) 37734544', '2026-04-26 23:08:47', '2026-04-26 23:08:47'),
(3, 'Văn Học', '18 Nguyễn Trường Tộ - Ba Đình - Hà Nội', 'info@nxbvanhoc.com.vn', '024.37163409', '2026-04-26 23:20:09', '2026-04-26 23:20:09'),
(4, 'Tri Thức', 'Tầng 7, Tòa nhà Liên hiệp các Hội Khoa học và Kỹ thuật Việt Nam, Lô D20, ngõ 19 Duy Tân, phường Cầu Giấy, TP. Hà Nội', 'truyenthong@nxbtrithuc.com.vn', '02466878415', '2026-04-26 23:24:47', '2026-04-26 23:24:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `readers`
--

CREATE TABLE `readers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `readers`
--

INSERT INTO `readers` (`id`, `name`, `email`, `created_at`, `updated_at`) VALUES
(1, 'hoang quang hop', '20220589@gmail.com', '2026-04-11 02:20:29', '2026-04-11 02:20:29'),
(3, 'admin', 'hop@gmail.com', '2026-04-18 23:36:29', '2026-04-18 23:36:29'),
(4, 'tao', '123@gmail.com', '2026-05-05 09:56:57', '2026-05-05 09:56:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('xcTA5H2C04rNgg7AzSpavyVuLWEND0n10FqhddwP', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ0pjQkFkVXp2c0JwcUI4S0hCdm5zME04T1E1SHhERDVaVXBSald6QSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWxlIjtzOjU6InJvdXRlIjtzOjEyOiJwcm9maWxlLmVkaXQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo4O30=', 1778001317);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shelves`
--

CREATE TABLE `shelves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `shelves`
--

INSERT INTO `shelves` (`id`, `name`, `location`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Sách Văn Học', 'Tầng 1A', NULL, '2026-04-26 22:59:20', '2026-04-26 22:59:20'),
(2, 'Sách Khoa Học', 'Tầng 1B', NULL, '2026-04-26 22:59:44', '2026-04-26 22:59:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff','user') DEFAULT 'user',
  `google_id` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `role`, `google_id`, `remember_token`, `created_at`, `updated_at`, `avatar`, `phone`) VALUES
(5, 'tao', '123@gmail.com', 'overhop', NULL, '$2y$12$Hv0uAc7/lrRa7gejH/E0CesKjFBJ4qyYjOJGOePcIMAZfq6xz/zrS', 'user', NULL, NULL, '2026-04-17 23:34:53', '2026-05-05 09:44:29', NULL, NULL),
(6, 'Admin Quản Trị', 'admin@email.com', 'admin', NULL, '$2y$12$UZQ0fhLRi/wzb1fKNg2GN./6tJh98aq17dr0FEjJknORJhFhuBHOS', 'admin', NULL, NULL, '2026-04-18 03:04:52', '2026-04-19 00:02:47', NULL, NULL),
(7, 'hop', 'overhop@gmail.com', 'nhanv1', NULL, '$2y$12$AS7yWKTMdqk/eqqlvSrxf.DkbevLTMioTsFVBfZ9zgo43/kz10K92', 'staff', NULL, NULL, '2026-05-05 09:39:24', '2026-05-05 09:39:24', NULL, '0123455677'),
(8, 'nhanv2', 'overhop354@gmail.com', 'nhanvien2', NULL, '$2y$12$qymBcJSGjqwcbfrRL0t/YeM6pisfHb6dGjEcwjtP5FLrSqPDAGuIu', 'staff', NULL, NULL, '2026-05-05 09:40:44', '2026-05-05 10:15:17', 'avatars/ZXGsF1GBQi9i0o4kDrxmWqxdVsb2cxuUydXRTeBc.jpg', '********');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `books_slug_unique` (`slug`),
  ADD KEY `books_publisher_id_foreign` (`publisher_id`);

--
-- Chỉ mục cho bảng `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `book_category_book_id_category_id_unique` (`book_id`,`category_id`),
  ADD KEY `book_category_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `borrows`
--
ALTER TABLE `borrows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrows_book_id_foreign` (`book_id`),
  ADD KEY `borrows_reader_id_foreign` (`reader_id`);

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_book_id_foreign` (`book_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`),
  ADD KEY `payments_book_id_foreign` (`book_id`),
  ADD KEY `payments_borrow_id_foreign` (`borrow_id`);

--
-- Chỉ mục cho bảng `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `readers`
--
ALTER TABLE `readers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `readers_email_unique` (`email`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_book_id_foreign` (`book_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `shelves`
--
ALTER TABLE `shelves`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `authors`
--
ALTER TABLE `authors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `book_category`
--
ALTER TABLE `book_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `borrows`
--
ALTER TABLE `borrows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `readers`
--
ALTER TABLE `readers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `shelves`
--
ALTER TABLE `shelves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_publisher_id_foreign` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `book_category`
--
ALTER TABLE `book_category`
  ADD CONSTRAINT `book_category_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `borrows`
--
ALTER TABLE `borrows`
  ADD CONSTRAINT `borrows_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrows_reader_id_foreign` FOREIGN KEY (`reader_id`) REFERENCES `readers` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_borrow_id_foreign` FOREIGN KEY (`borrow_id`) REFERENCES `borrows` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
