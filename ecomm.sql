SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


--
-- Database: `ecomm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `email`, `mobile`) VALUES
(1, 'admin', 'admin', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `email` varchar(75) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `mobile` varchar(15) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `comment` text CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `comment`, `added_on`) VALUES
(0, 'Nhanh', 'longnhanh19@gmail.com', '0123456789', 'cây khỏe giá tốt', '2023-10-18 11:17:57');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `orname` varchar(11) NOT NULL,
  `address` varchar(250) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `ormobile` varchar(50) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `total_price` float NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `order_status` int(11) NOT NULL,
  `txnid` varchar(200) NOT NULL,
  `added_on` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `ship_order_id` int(11) NOT NULL,
  `ship_shipment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `orname`, `address`, `ormobile`, `payment_type`, `total_price`, `payment_status`, `order_status`, `txnid`, `added_on`, `user_id`, `ship_order_id`, `ship_shipment_id`) VALUES
(20, 'Long', '0231354667', 'An Giang', 'COD', 550000, 'pending', 1, '86cf3d17c905bd614705', '2023-10-25 04:23:22', 3, 0, 0),
(21, 'Hu?nh', '0974558544', 'AnGiang', 'COD', 90000, 'pending', 1, 'a197a78ec3737bca2b20', '2023-10-25 04:26:51', 4, 0, 0),
(22, 'Nhanh', '0231354667', 'cantho', 'COD', 480000, 'pending', 1, '5db83864c320a5e33dfe', '2023-10-30 03:09:47', 3, 0, 0),
(23, 'Nhanh', '0231354667', 'cantho', 'COD', 480000, 'pending', 1, '78e03ca189edfdef14e9', '2023-10-30 03:10:12', 3, 0, 0),
(24, 'Nhanh', '0231354667', 'cantho', 'COD', 90000, 'pending', 1, '98eef2a73940a79047d5', '2023-10-30 03:17:27', 3, 0, 0),
(25, 'Nhanh', '0231354667', 'cantho', 'COD', 50000, 'pending', 1, 'bb43da25db61bf213492', '2023-11-06 02:45:15', 3, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_attr_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_attr_id`, `qty`, `price`, `product_id`) VALUES
(29, 20, 0, 1, 420000, 23),
(30, 20, 0, 2, 65000, 27),
(31, 21, 0, 1, 90000, 30),
(32, 22, 0, 3, 160000, 28),
(33, 23, 0, 3, 160000, 28),
(34, 24, 0, 1, 90000, 30),
(35, 25, 0, 1, 50000, 34);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Shipped'),
(4, 'Canceled'),
(5, 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(255) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `added_by` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `qty`, `image`, `description`, `added_by`, `status`) VALUES
(2, 'Cau Tiểu Trâm', 55000, 10, 'cautieutram1.jpg', 'Cau Tiểu Trâm mang ý nghĩa vô cùng tích cực, đại diện cho sức sống mạnh mẽ, không ngừng vươn lên nó trở thành quà tặng để khích lệ, động viên trong những dịp đặc biệt như: Thi cử, tân gia, lễ tết, thăng chức, sinh nhật, khai trương…\r\nHơn thế nữa, với công dụng là lọc sạch không khí bằng cách vô hiệu hóa các chất độc hại như: Bụi bẩn, bức xạ từ máy tính, xăng dầu, khói thuốc lá, các tia bức xạ từ đồ điện tử,… Cây sẽ giúp bảo vệ sức khỏe cho cả gia đình.\r\nĐặc biệt với những người mắc một số bệnh về đường hô hấp như: Viêm xoang, hen suyễn… Chắc chắn nên sở hữu một cây Cau Tiểu Trâm và bạn sẽ thấy sức khỏe của mình được cải thiện lên rõ rệt.', 0, 1),
(3, 'Kim Tiền', 60000, 10, 'kimtien1.jpg', 'Nhắc đến tên của cây Kim Tiền cũng đã thể hiện được ý nghĩa của bản thân. Cây Kim Tiền mang đến cho gia chủ về tài lộc, may mắn, tiền tài, phú quý, giàu sang, sung túc, thịnh vượng.\r\nTừ “Kim” có nghĩa là phát tài, “Tiền” có nghĩa là giàu sang phú quý. Đặc biệt khi cây Kim Tiền ra hoa đại diện vận may của gia chủ ngày càng phát, tiền tài, lợi lộc, may mắn cũng ngày càng nhiều.\r\nCây Kim Tiền mang đến cho gia chủ nhiều điều may mắn về tài lộc\r\nNgười ta thường treo thêm trên cây Kim Tiền những chiếc nơ màu đỏ hoặc những dây đồng tiền vàng tượng trưng cho Hỏa và Kim. Việc trang trí nhằm tăng thêm vượng khí cho cây và giúp chậu cây hội tụ đủ các yếu tố trong ngũ hành\r\nTrong phong thủy cây Kim Tiền là Mộc, nơi cây sống và phát triển là Thổ, nước tưới cho cây phát triển thuộc Thủy.', 0, 1),
(4, 'Phát Tài Núi', 70000, 10, 'phattainui1.jpg', 'Cây Phát Tài Núi có thân cây uyển chuyển cùng với những cụm tán lá xanh mướt bên trên thích hợp để làm tiểu cảnh sân vườn hoặc ban công, sân thượng,…Ngoài ra, người ta cũng thích trồng cây trong chậu sứ để trang trí trong nhà, văn phòng làm việc, quán cà phê, nhà hàng…\r\nCây Phát Tài Núi là cây có sức sống bền bỉ và luôn xanh tươi bởi cụm lá mang lại không gian thoáng mát và tràn trề sinh khí. Chính vì thế, loại cây này mang đến nhiều may mắn, tài lộc cho gia chủ nên được trồng nhiều trong các gia đình. Bên cạnh đó, theo đúng tên gọi là cây “Phát Tài”, loại cây này sẽ mang lại nhiều thuận lợi trong sự nghiệp và may mắn trong cuộc sống.', 0, 1),
(6, 'Trầu Bà Leo Cột', 350000, 10, 'traubaleocot1.jpg', 'Trầu Bà Leo Cột tượng trưng cho sự thăng tiến trong công việc, mang đến tiền tài và thịnh vượng cho gia chủ. Với ý nghĩa mang lại may mắn cho những người trồng chậu Trầu Bà trong nhà. Đồng thời khi cây Trầu Bà Leo Cột cũng giống như sự thăng tiến trong công việc. Để từ đó mang lại tiền tài và sự thịnh vượng cho gia tộc của mình. Những chiếc lá to lớn bóng bẩy mọc đều xung quanh thân, với biểu tượng mang đến cho người sở hữu sự thành công, thịnh vượng và yên bình. Bên cạnh đó, Trầu Bà Leo Cột có sức sống mạnh mẽ dẻo dai nên là biểu tượng cho sức khỏe và trường thọ.', 0, 1),
(7, 'Chân Chim', 110000, 0, 'chanchim1.jpg', 'Cây Chân Chim mang ý nghĩa đem đến sự tự nhiên, hòa thuận trong gia đình. Tặng nhau loài cây này cũng là mong muốn gắn kết tình thân.\r\nCây biểu tượng cho thịnh vượng và phát triển bền vững. Bạn đặt cây ở trong nhà hay văn phòng, tiền tài lộc, may mắn sẽ đến với bạn cũng như là gia đình và mọi người. Công việc sẽ trở nên thuận lợi, suôn sẻ và điều xui xẻo sẽ nhanh chóng bị xua đuổi đi.\r\n', 0, 1),
(8, 'Trầu Bà Lỗ', 60000, 10, 'traubalo1.jpg', 'Cây Trầu Bà Lỗ được nhiều người trồng bởi câu chuyện phong thủy của chính loại cây này mang lại.\r\nCây Trầu Bà Lỗ có tác dụng thanh lọc không khí cực kỳ tốt chỉ đứng sau cây Lưỡi Hổ. Bên cạnh đó cây Trầu Bà Lỗ còn mang nhiều giá trị phong thủy cho gia đình của bạn, chúng kích thích vận may khí tốt trong nhà, mang tới cho gia chủ nhiều tài lộc, phú quý.\r\nNgoài ra, cây Trầu Bà Lỗ có màu sắc tươi mát, xanh tươi, thân hình bé nhỏ dễ thương nên chúng rất thích hợp với các bạn nữ.\r\nBạn có thể dùng cây trầu bà lỗ để làm quà tặng bạn bè với ý nghĩa mong muốn họ luôn tươi trẻ, phấn chấn và xua tan đi bao mệt mỏi, buồn phiền.', 0, 1),
(9, 'Thiết Mộc Lan', 230000, 10, 'thietmoclan1.jpg', 'Trong phong thủy, cây Thiết Mộc Lan được đánh giá là đem lại nhiều sinh khí, may mắn và thịnh vượng cho gia chủ, nhất là khi cây nở hoa là dấu hiệu tiền tài đang đến với bạn. Hơn nữa, nếu bạn đặt cây theo hướng Đông hay Đông Nam của ngôi nhà thì sẽ đem tới nhiều may mắn bởi cây là đại diện cho hành Mộc.\r\nThiết Mộc Lan còn là loại cây được đánh giá là có sức sống cực kỳ bền bỉ. Bạn chỉ cần trồng một cành nhỏ xuống đất là chúng đã có thể phát triển thành một cây to lớn, khỏe mạnh. Chiều cao của chúng thường có thể đến tận 6m nếu trồng trong tự nhiên đấy.\r\nCây Thiết Mộc Lan có tác dụng lọc bỏ những độc tố có trong không khí, hấp thụ toàn bộ monoxide de carbone. Nhờ vậy mà không khí cũng được cải thiện nhiều hơn, bớt ô nhiễm hơn.\r\nChính vì vậy trồng cây thiết mộc lan trong nhà sẽ giúp cho sức khỏe các thành viên trong gia đình tốt hơn rất nhiều, trạng thái tinh thần được duy trì ổn định, sảng khoái và sản sinh ra nhiều nguồn năng lượng tích cực.', 0, 1),
(10, 'Cọ Nhật', 370000, 10, 'conhat1.jpg', 'Với hình dáng độc đáo đẹp mắt, công dụng chính của cây Cọ Nhật vẫn là trồng cảnh. Cây có thể trang trí ở nhiều vị trí khác nhau trong đó phổ biến nhất là làm cây nội thất.\r\nVới những cây lớn, bạn có thể trồng cây trang trí sân vườn, lối đi, trang trí công trình. Cây có kích thước nhỏ hơn thường được trồng trong chậu, trang trí không gian văn phòng, phòng khách, phòng ăn hay giếng trời đều rất đẹp.\r\nCọ Nhật còn được biết đến là loài cây có khả năng loại bỏ bụi bẩn, thanh lọc không khí, giúp môi trường sống trong sạch, lành mạnh hơn.\r\nCây này còn có khả năng xua đuổi côn trùng, ruồi muỗi rất tốt đấy.\r\nNgoài ra, Cọ cảnh còn thường được sử dụng làm quà tặng trong những dịp đặc biệt bởi cây mang nhiều ý nghĩa tốt đẹp.\r\nÝ nghĩa của cây Cọ Nhật\r\nTrong phong thủy, cây Cọ Nhật được biết đến là loài cây mang lại nhiều may mắn, tài lộc. Điều này là do hình dáng lá cây tương tự như biểu tượng bàn tay xòe ra hứng lộc.\r\nNgười ta trồng hay tặng cây Cọ Nhật với mong muốn người nhận gặp nhiều may mắn trong cuộc sống, thăng tiến trong công việc, sự nghiệp.\r\nCây Cọ Nhật phù hợp với hầu hết các tuổi và mệnh, trong đó người tuổi Dậu là phù hợp nhất. Người tuổi Dậu khi trồng cây sẽ phát huy tối đa những yếu tố phong thủy mà cây mang lại.', 0, 1),
(11, 'Môn Thanh Tâm', 990000, 10, 'monthanhtam1.jpg', 'Cây Môn Thanh Tâm được nhiều người lựa chọn làm cây kiểng trong nhà, trang trí không gian sống và làm việc bởi cây dễ chăm sóc, có màu xanh tươi mát và thanh thoát như xua tan những cơn căng thẳng, áp lực và tô điểm thêm một màu xanh hy vọng trong cuộc sống.\r\nNgoài ra, nó còn có khả năng lọc không khí, hấp thụ các bức xạ, tia tử ngoại từ thiết bị điện tử. Có thể dùng làm quà tặng cho người thân, bạn bè, đồng nghiệp với câu chúc an lành, bình an hay làm quà khai trương với mong muốn mua mai bán đắt, không gặp nhiều thị phi.\r\nCây Môn Thanh Tâm là loài cây thủy canh, có màu xanh mướt, rễ màu trắng nên rất phù hợp với người mệnh Mộc và Thủy, tuy nhiên do ngũ hành tương sinh nên Thủy sinh Mộc, do đó người mệnh Mộc sẽ được lợi nhiều khi trồng cây này trong nhà hay đặt trong phòng làm việc.\r\nNgoài ra, màu trắng của rễ cây là biểu tượng của mệnh Kim, tương sinh với mệnh Thủy, với việc trồng thủy canh nên mệnh Thủy cũng hợp cây Môn Thanh Tâm, dù sẽ bị thuộc tính Mộc hút bớt nhưng do có nước nên sẽ được bù đắp nên không sao.', 0, 1),
(12, 'Ổ Phụng', 110000, 10, 'ophung1.jpg', 'Cây Ổ Phụng có những chiếc lá lớn xếp chồng lên nhau, bảo vệ cho những chiếc lá nhỏ hơn bên trong, tựa như một gia đình đùm bọc lẫn nhau.\r\nVì hình dáng đặc biệt của lá cây này mà trong phong thủy, cây được cho rằng có tác dụng duy trì hòa khí, sự ấm êm trong gia đình.\r\nCây hợp với những người mang trong mình mệnh Hỏa và Thủy. Những người thuộc 2 mệnh này khi trồng cây Ổ Phụng sẽ giúp vận khí công việc hanh thông hơn, ngoài ra còn giúp gia đình, anh chị em trong nhà hòa thuận.\r\nNgoài ra, chim Phụng hay chim Phượng là loài chim được ví như loài chim của sức sống mãnh liệt, và sự tái sinh từ ngọn lửa. Vì thế chữ \"Phụng\" trong tên của cây còn mang hàm nghĩa là nói loài cây này sống đầy mạnh mẽ, và dai dẳng bất chấp mưa sa bão táp vô cùng khắc nhiệt ở trong rừng.\r\n', 0, 1),
(13, 'Dương Xỉ', 80000, 10, 'duongxi1.jpg', 'Cây Dương Xỉ không chỉ biết đến như một loại cây cảnh trang trí sân vườn mà nó còn là “thần dược” chữa các bệnh như: Lang ben, bạch biến, đau lưng, đau mỏi đầu gối, cầm máu… Chỉ với một vài thao tác sơ chế đơn giản, khách hàng đã có thể giảm các cơn đau hằng ngày. Đồng thời mang lại vẻ ngoài phấn chấn và khỏe khoắn cho người dùng.\r\nKhông chỉ vậy, cây Dương Xỉ còn làm giảm lượng asen trong đất, lọc không khí và xử lý ô nhiễm. Nhờ các hàm lượng chất dinh dưỡng có trong lá cây, nó giảm thiểu các bệnh hô hấp, đường ruột cho người dùng. Song song với đó là cơ chế đào thải chất độc cũng được phát huy hiệu quả. Nó chẳng những mang lại môi trường trong lành, sạch đẹp cho người dùng mà còn giảm thiểu những căn bệnh không mong muốn có thể xảy ra.\r\nBên cạnh những tác dụng lớn, cây Dương Xỉ còn tượng trưng cho sức sống mãnh liệt và sự tươi mới trong sự nghiệp. Vẻ ngoài kiên cường cùng khả năng sinh trưởng, phát triển tốt là tiền đề giúp cho gia chủ phát triển trong chặng đường sắp tới.\r\nQuý khách cũng có thể tặng cây Dương Xỉ cho người thân với mong muốn gửi lời tri ân sâu sắc, mong cho sức khoẻ dồi dào và thành công luôn mỉm cười. Chính những ý nghĩa này khiến cho Dương Xỉ trở thành một công cụ gắn kết yêu thương, mang đến thành công và may mắn cho gia chủ.\r\n', 0, 1),
(15, 'Nguyệt Quế', 550000, 10, 'nguyetque1.jpg', 'Nhiều người trồng cây Nguyệt Quế với mong muốn là cây sẽ mang lại thành công trên con đường công danh, sự nghiệp, mang lại tiền tài cho gia chủ. Bên cạnh đó, cây còn có khả năng xua đuổi tà khí, ma quỷ và những điều xui xẻo trong cuộc sống, mang đến may mắn cho gia đình.\r\nCây Nguyệt Quế còn có mùi thơm sẽ làm tinh thần các thành viên trong gia đình thư giãn, giải tỏa phiền muộn trong cuộc sống. Trồng cây Nguyệt Quế trong nhà còn là cách để cầu bình an, đỗ đạt thành tài cho con cháu trong nhà.\r\n', 0, 1),
(16, 'Mai Vạn Phúc', 70000, 10, 'maivanphuc1.jpg', 'Cây Mai Vạn Phúc hay còn được gọi với tên khác là cây Mai Tiểu Thư hay cây Mai Chỉ Thiên, có tên khoa học là Tabernaemontana dwarf, thuộc họ trúc đào (Apocynaceae) xuất phát nguồn gốc từ Châu Á và dần trở nên phổ biến ở Việt Nam vì cây đẹp, phù hợp với trang trí các khuôn viên trong nhà.\r\nTrong phong thuỷ, cây Mai Vạn Phúc có ý nghĩa về vẻ đẹp tinh khiết, thanh tao và khí tiết trong sáng của một người quân tử và vì thế hoa Mai Vạn Phúc giúp xua đuổi những luồng khí độc, u ám, diệt trừ tà ma. Ngay từ trong cái tên mai “Vạn Phúc” cũng ngầm thể hiện rằng ý nghĩa của cây là mang lại những điều tốt lành, sự may mắn và niềm vui cho gia chủ.', 0, 1),
(17, 'Trầu Bà Đế Vương', 380000, 10, 'traubadevuong1.jpg', 'Cây Trầu Bà Đế Vương được yêu thích không chỉ bởi vẻ đẹp sang trọng, quý phái mà loài cây này còn mang những ý nghĩa tốt đẹp trong phong thủy.\r\nTheo những quan niệm trong phong thủy ngũ hành, cây Trầu Bà Đế Vương rất phù hợp với người mang mệnh Mộc, có tác dụng giúp gia chủ gặp nhiều thuận lợi trong công việc làm ăn, mọi sự phát đạt, gặp nhiều may mắn, tài lộc và thịnh vượng.\r\nNgoài ra, bạn cần trồng và chăm sóc cây Trầu Bà Đế Vương thật cẩn thận để cây có thể sinh trưởng, phát triển tốt. Người xưa thường hay nói cây phát triển tốt, lá xanh tươi thì tiền bạc tự ắt sẽ đến. Nhưng nếu để cây héo rũ thì gia đình sẽ gặp phải những điều không thuận lợi, may mắn.\r\nBởi vì có ý nghĩa mang đến nhiều tài lộc, may mắn nên loài cây này thường được dùng làm quà tặng trong các dịp khai trương, nhậm chức, tân gia,...\r\nNgoài những ý nghĩa tốt trong phong thủy, cây Trầu Bà Đế Vương còn có nhiều công dụng bất ngờ khiến mọi người yêu thích trồng loài cây này trong nhà.\r\nTrồng cây trầu bà đế vương giúp không khí trong nhà được thanh lọc nhờ khả năng hút các chất độc trong môi trường xung quanh cây. Từ đó, tạo nên cảm giác dễ chịu, thông thoáng trong phòng, giúp bạn gia tăng khả năng tập trung và ghi nhớ, tinh thần thoải mái và tăng năng suất làm việc của bạn.\r\nCây Trầu Bà Đế Vương còn có khả năng giảm nhiệt trường được phát ra từ các thiết bị điện tử trong phòng.\r\nCuối cùng, việc trồng cây trầu bà đế vương còn giúp tạo nên mỹ quan cho văn phòng, khiến văn phòng được gần gũi với thiên nhiên, tạo thiện cảm cho người vào trong.\r\n', 0, 1),
(18, 'Trầu Bà Đế Vương Đỏ', 760000, 10, 'traubadevuongdo1.jpg', 'Sở hữu cho mình cái tên đầy quyền uy, Đế Vương Đỏ mang ý nghĩa may mắn, thịnh vượng. Trong quan niệm của người Á Đông, màu đỏ luôn là màu sắc mang lại niềm vui và may mắn. Màu đỏ của cây vì thế cũng lây dính ý nghĩa này. Đế Vương Đỏ được giới phong thuỷ xem là loài cây mang lại tiền tài và vận khí tốt cho gia chủ. Cây thể hiện sự vươn lên, thăng tiến trong công việc cũng như học tập.\r\nCây rất phù hợp với những người lãnh đạo, quản lý trồng trang trí phòng làm việc, phòng họp. Hoặc trang trí văn phòng, nơi làm việc nhằm tạo sự thư thái và khích lệ tinh thần nỗ lực làm việc của mọi người.\r\nTrầu Bà Đế Vương với toàn thân màu đỏ tía nên được xếp vào cây thuộc hành Hoả. Người mệnh Hoả trồng cây này sẽ giúp họ thu hút được nhiều may mắn và tài lộc. Đồng thời, cũng giúp họ xua đuổi vận xui và những điều không may.\r\nTheo thuyết Ngũ hành tương sinh thì Hoả sinh Thổ. Vì vậy, người mệnh Thổ cũng có thể trồng cây này để gia tăng thêm may mắn và bình an.', 0, 1),
(19, 'Trầu Bà Đế Vương Vàng', 460000, 10, 'traubadevuongvang1.jpg', 'Trầu Bà Đế Vương Vàng đã được khoa học chỉ ra rằng chúng có tác dụng lọc khí rất tốt, giúp hấp thụ lượng lớn khí thải độc hại và giảm thiểu sự ô nhiễm ozon cho môi trường xung quanh.\r\nVì vậy lựa chọn Trầu Bà Đế Vương Vàng làm cây cảnh nội thất vừa giúp tăng vẻ đẹp mỹ quan, vừa hỗ trợ cho việc điều hòa không khí giúp tăng cường sức khỏe của con người.\r\nVề mặt phong thủy, từ xa xưa mọi người đã quan niệm rằng Trầu Bà Đế Vương Vàng đem lại cho người sở hữu nhiều may mắn, tài lộc và luồng sinh khí tốt cho không gian sinh hoạt. Trầu bà đế vương vàng được xem như thần hộ mệnh đem tới cho gia chủ nhiều tài lộc và may mắn. Với cái tên “Trầu Bà Đế Vương Vàng” đầy quyền lực của mình, loài cây này sẽ giúp gia chủ có thể tránh xa những điều không may mắn, thị phi trong cuộc sống thường ngày.\r\nCây có khả năng sinh sống tốt. ít bị nhiễm bệnh hoặc nấm hại, lá cây Trầu Bà Đế Vương Vàng xanh tốt lâu nên có thể chơi trong thời gian tương đối dài.\r\nVới vẻ đẹp sang trọng, quý phái của Trầu Bà Đế Vương Vàng, loài cây này thể hiện tinh thân đế vương, quyền uy. Thích hợp với những người quản lý , lãnh đạo cho một công ty hay tổ chức.\r\nNgoài ra, tên của chúng cũng góp phần thể hiện ý chí quyết tâm, không ngừng nỗ lực để hướng tới vị trí cao hơn.', 0, 1),
(20, 'Lan Ý Mỹ', 490000, 10, 'lanymy1.jpg', 'Lan Ý Mỹ là một trong số rất ít những loại  cây trồng có khả năng làm giảm thiểu tác hại của các tia tử ngoại và sóng điện từ có hại cho cơ thể. Khi đặt Lan Ý Mỹ hay Lan Mỹ trong nhà chúng sẽ giúp cân bằng các nguồn sóng trong không gian phòng như những tia điện từ sinh ra từ tivi, đài, máy tính, đồng hồ, lò vi sóng, tủ lạnh…. cây Lan Ý Mỹ còn mang ý nghĩa khỏe khoắn đem đến may mắn, tài lộc cho gia chủ phù hợp để làm cây quà tặng cho khai trương, sinh nhật, tân gia…', 0, 1),
(21, 'Lược Vàng', 50000, 10, 'luocvang1.jpg', 'Theo một số kinh nghiệm dân gian, Lược Vàng có nhiều công dụng chữa bệnh; như các chứng bệnh tim mạch, tăng huyết áp, hay thoái hóa đốt sống cổ, viêm gan, táo bón, chảy máu dạ dày, tiểu đường, thấp khớp, chấn thương trầy xước, viêm họng, viêm mũi, u xơ tuyến tiền liệt, ung thư, đau lưng, bỏng, say rượu….\r\nLoài cây này với sắc xanh, đặt trong văn phòng làm việc hay không gian sống đều mang lại cảm giác tươi mới, đầy sức sống và năng lượng\r\nLược Vàng không chỉ là loại cây cảnh đẹp, giá trị cao và nổi tiếng nhờ công dụng chữa bệnh hiệu quả; mà nếu đặt cây trong nhà và chăm sóc hiệu quả thì cây mang yếu tố phong thủy tốt. Lược Vàng giúp mang lại may mắn, tiền tài, sung túc trong cuộc sống. Cây còn mang ý nghĩa về sức khỏe. Vì nếu trồng lược vàng sẽ giúp gia đình dồi dào sức khỏe.\r\n', 0, 1),
(22, 'Trầu Bà Thanh Xuân', 690000, 10, 'traubathanhxuan1.jpg', 'Trầu Bà Thanh Xuân có lá đẹp, lạ mắt và độc đáo, thường dùng nhiều trong nội thất như trồng trong chậu đứng tráng trí văn phòng; công ty; nhà ở… Đối với những cây Trầu Bà Thanh Xuân có kích thước nhỏ có thể trồng chậu để làm cây để bàn trang trí nhà ở; văn phòng; không gian quán cà phê; khu du lịch…\r\nVới màu xanh tươi sáng, hình dáng lá đẹp, cây được dùng trang trí cho không gian thêm sinh động hoặc được dùng làm quà tặng ý nghĩa trong dịp khai trương; khánh thành; tân gia hay mừng năm mới. Trầu Bà Thanh Xuân có khả năng giữ ẩm tốt, nên được dùng để trang trí trong văn phòng (nơi có máy điều hòa); giúp cân bằng độ ẩm; hạn chế khô da cho dân văn phòng.\r\nCây còn có khả năng thanh lọc không khí tốt, đặt một cây trong nhà vừa giúp không gian trở nên sinh động; vừa mang lại cảm giác dễ chịu và thoải mái. Đặt biệt, cây còn hấp thụ các khí độc hại thải ra từ khói thuốc lá, xăng xe (benzen); không gian nhỏ. Giúp không khí lưu thông tốt; hạn chế các bệnh về đường hô hấp.\r\nTheo quan niệm phong thủy, Trầu bà thanh xuân sẽ mang đến tài lộc, sự thanh tịnh, bình an và niềm vui cho gia chủ. Màu xanh tươi của cây không chỉ giúp cho không gian sinh động mà còn rất phù hợp với những người mệnh Mộc. Người mệnh Mộc và mệnh Hỏa (Mộc sinh Hỏa) sở hữu Trầu Bà Thanh Xuân trong nhà sẽ giúp tăng thêm vượng khí, mang lại nhiều may mắn và tài lộc.\r\n', 0, 1),
(23, 'Trúc Bách Hợp', 420000, 10, 'trucbachhop1.jpg', 'Trong tự nhiên, cây Trúc Bách Hợp có tác dụng thanh lọc không khí, đem lại một bầu không khí phần nào trong lành hơn nên được dùng làm cây cảnh. Bên cạnh đó với hình dáng bắt mắt nên cây cũng được đặt ở bàn làm việc, ban công, kệ sách, phòng khách, hàng quán, công viên,...\r\nMột số bác sĩ y học cổ truyền tại Madagascar đã sử dụng loài cây này vào việc chữa các bệnh như: Tiêu chảy, kiết lỵ, đau bụng kinh, cầm máu,...Theo đó, vỏ cây và lá được dùng để trộn với các loại cây thảo dược khác để làm thuốc. Tuy vậy, những công dụng này của cây Trúc Bách Hợp đối với sức khỏe con người vẫn chưa được chứng minh, do đó bạn không nên tự tiện sử dụng để chữa bệnh mà không có sự tư vấn từ bác sĩ, chuyên gia nhé!\r\nNgay từ tên gọi thì loại cây này đã mang ý chỉ may mắn, theo đó trong tiếng Hán Việt, “Trúc” đồng âm với “chúc” thể hiện sự cầu mong mọi điều may mắn, suôn sẻ. Chính vì vậy mà loại cây này thường được nhiều người dùng trong dịp tặng khai trương, khánh thành, tân gia để như gửi những lời chúc tốt đẹp nhất đến người nhận.\r\nBên cạnh đó, cây Trúc Bách Hợp hợp nhất với người mệnh Thổ theo quan niệm trong ngũ hành, vì màu vàng trên lá hợp với mệnh này. Cây Trúc Bách Hợp sẽ giúp gia chủ có công việc thuận lợi, dễ thăng tiến. Ngoài ra cây còn phù hợp với người tuổi Hợi, tuổi Dần.\r\n', 0, 1),
(24, 'Dứa Vạn Phát', 30000, 10, 'duavanphat1.jpg', 'Cây Dứa Vạn Phát với màu xanh bắt mắt thể hiện cho sự may mắn và tài lộc cho gia chủ. Cây được trồng làm cây cảnh trang trí nội thất cũng như ngoại thất, trang trí tại phòng làm việc, bàn tiếp khách hay tại các khu đô thị, công viên, đường phố… Cây hấp thụ khí độc rất tốt mang lại bầu không khí trong lành.', 0, 1),
(25, 'Vạn Niên Thanh', 80000, 10, 'vannienthanh1.jpg', 'Cây Vạn Niên Thanh được nhiều người sử dụng trong việc trang trí nhà cửa, góc làm việc… để tạo một không gian xanh và môi trường tràn đầy sức sống.\r\nCác tia bức xạ phát ra từ các thiết bị điện tử như máy tính, tivi sẽ gây ra những ảnh hưởng xấu đến sức khỏe nếu không xử lý kịp thời. Với tác dụng lọc không khí được sạch sẽ, cây vạn niên là sự lựa chọn hàng đầu của nhiều hộ gia đình. Ngoài ra, Vạn Niên Thanh giúp người chơi có được cảm giác thoải mái, dễ chịu, tăng cao hiệu quả làm việc.\r\nTheo một số nghiên cứu, Vạn Niên Thanh có tác dụng thanh nhiệt, lợi tiểu, cầm máu và chữa bệnh bạch hầu. Tham khảo ý kiến của bác sĩ đông y, thầy thuốc trước khi dùng.\r\nVạn Niên Thanh là một trong số ít loại cây đem lại sự may mắn, thịnh vượng cho gia chủ. Vì vậy, loai cây này được dùng để làm quà biếu vào mỗi dịp đặc biệt như năm mới, báo hỷ, mừng tuổi… với mong ước cầu cho gia chủ được may mắn, sung túc.\r\n', 0, 1),
(26, 'Ngọc Ngân', 350000, 10, 'ngocngan1.jpg', 'Cái tên Ngọc Ngân của loài cây này bắt nguồn từ màu sắc của nó, màu trắng chỉ ngân màu xanh chỉ ngọc, tổng thể ghép lại “Ngọc Ngân” là vừa sang vừa quý. Chữ “Ngân” có nghĩa là tiền bạc nên cây mang ý nghĩa tài lộc.\r\nChữ “Ngọc” ý chỉ con người, quan niệm xưa nghĩa ai mang ngọc bên người thì nhờ đó mà tụ lại những sinh khí, vận khí quanh đó về người mang ngọc nên mới có câu “ngọc dưỡng người” cũng như ngọc ngày xưa rất quý giá, không phải ai cũng có để mang và nhiều dạng trong đó có lục ngọc như màu xanh của cây này nên người ta dùng từ này ghép với từ “Ngân” để ám chỉ sự giàu sang, phú quý.\r\nNgoài ra, cây còn mang ý nghĩa sự gắn bó trong tình yêu đôi lứa bởi màu sắc đan xen giữa trắng và xanh như “trong anh có em” hoặc “trong em có anh”, vì vậy nó mới có cái tên mỹ miều khác là cây Valentine.\r\nXét về mặt cung mệnh thì cây ngọc ngân rất hợp hành Kim bởi màu trắng của loài cây này, mà trong thuyết ngũ hành thì Thổ sinh Kim, Kim sinh Thủy cho nên mệnh Thủy và Thổ cũng khá hợp khi trồng cây này trong nhà để giúp khắc chế tính xấu của bản thân và mang may mắn, danh vọng cho chủ mệnh.', 0, 1),
(27, 'Phú Quý', 65000, 10, 'phuquy1.jpg', 'Ngoài làm trang trí trong nhà hay văn phòng do mang ý nghĩa tốt lành, cây Phú Quý còn có những công dụng khác có ích cho đời sống.\r\nCây phú quý có khả năng lọc không khí tốt, loại bỏ các khí độc như formaldehyde, benzen, giảm bớt khói bụi giúp cho môi trường sống trong lành hơn. Ngoài ra, cây có có tác dụng giảm căng thẳng, tinh thần minh mẫn, vui vẻ khi cây tỏa ra năng lượng tích cực cho bạn.\r\nCái tên Phú Quý mà chúng ta hay gọi cũng đã nói lên ý nghĩa của cây. Cây Phú Quý tượng trưng cho sự may mắn, tài lộc và giàu sang nên người ta có câu “ giàu sang phú quý” hay “phú quý cát tường”. Vì vậy cây thường được xem là món quà để tặng cho các dịp tân gia, khai trương, lễ tết,...\r\n', 0, 1),
(28, 'Lưỡi Hổ Bantel Sensation', 160000, 10, 'luoihobantel1.jpg', 'Cây Lưỡi Hổ Bantel Sensation cùng họ với nha đam, nhưng nó vẫn có độc tính, nếu ăn nhiều và trực tiếp cây Lưỡi Hổ sẽ gây độc. Không may nuốt hoặc nhai cây Lưỡi Hổ, bạn sẽ có cảm giác buồn nôn và người nào nhạy cảm sẽ có kích ứng da. Vì vậy, đây là cây trang trí có tác dụng bên ngoài chứ không sử dụng như một liều thuốc uống hay dùng trực tiếp, bạn nên lưu ý nếu nhà có trẻ nhỏ để tránh tình trạng trẻ bẻ lá và nuốt phải.\r\n\r\nTrên thực tế, chưa có trường hợp ngộ độc do Lưỡi Hổ gây ra. Do đó bạn hoàn toàn yên tâm khi trồng và chăm sóc cây tại nhà.\r\nCây Lưỡi Hổ Bantel Sensation có thân thẳng hình dáng sắc nhọn như lưỡi kiếm có ý nghĩa tượng trưng của người quân tử, khí phách kiên cường, có chí hướng vươn lên trong cuộc sống. Dáng vẻ uy nghi từ thân đến ngọn của cây lưỡi hổ là biểu tượng của sự uy quyền, danh gia vọng tộc, phú quý và may mắn mang lại cho chủ nhân.\r\nNgười Trung Hoa trồng loại cây này trong nhà như một cây quý giá có ý nghĩa phong thủy hưng thịnh, vì tám vị thần sẽ ban tặng 8 đức tính quý giá của họ cho người sở hữu cây Lưỡi Hổ: Thịnh vượng, sắc đẹp, sống lâu, thông minh, sức khỏe, nghệ thuật, sức mạnh và thơ ca.', 0, 1),
(29, 'Phúc Lộc Thọ', 55000, 10, 'phucloctho1.jpg', 'Cây Phúc Lộc Thọ trong phong thủy ta có thể thấy, cái tên nói lên tất cả rồi.  Cây cảnh Phúc Lộc Thọ đem đến tài lộc, sức khỏe, may mắn và sự bình an đúng như tên gọi của nó. \r\nTrong quan niệm của người Việt Nam, phong thủy là yếu tố vô cùng quan trọng, đặc biệt phong thủy cây Phúc Lộc Thọ càng được nhiều người quan tâm. Trong bố trí không gian sống và làm việc ngoài việc có giá trị thẩm mỹ cao, thì cây hoa Phúc Lộc Thọ còn mang đến những điều an lành. Vì vậy, cây Phúc Lộc Thọ được rất nhiều gia chủ lựa chọn trang trí cho ngôi nhà và ngôi vườn của mình. Ngoài ra, cây cũng được lựa chọn làm món quà tặng đối tác hay người thân ý nghĩa nhất thay cho những lời chúc tốt đẹp nhất. \r\n', 0, 1),
(30, 'Giữ Tiền', 90000, 10, 'giutien1.jpg', 'Trồng cây Giữ Tiền trong nhà vừa thu hút tài lộc, tiền tài cho gia chủ vừa giữ tiền của gia chủ rất tốt. Khi trang trí một chậu cây Giữ Tiền ở phòng làm việc hay phòng khách trong nhà bạn, các bạn sẽ cảm thấy yên tâm với tiền tài của mình.\r\nBên cạnh đó, cây Giữ Tiền là một loại cây có sức sống vô cùng mãnh liệt, bền bỉ, mang ý nghĩa của sự cố gắng, luôn luôn vươn lên, vượt qua mọi khó khăn trong cuộc sống để tiến đến thành công.\r\nCây giữ tiền là một loại cây rất hiếm ra hoa, nhưng khi bạn trồng trong nhà và cây ra hoa sẽ là một dấu hiệu tốt đối với gia chủ và những điều may mắn, những điều lành sẽ sắp đến.\r\nQuan niệm về ngũ hành tương sinh thì cây Giữ Tiền rất hợp với mệnh Kim và mệnh Hỏa. Những người thuộc hai nhóm mệnh này thường sẽ có tính cách mạnh mẽ và kiên định trong cuộc sống. Bên cạnh đó, cây Giữ Tiền cũng hợp với người có mệnh Tý.\r\nCây giữ tiền thuộc giống cây trồng trong nhà, cây có công dụng lọc không khí, tiêu diệt những vi khuẩn có hại và giảm bớt những bức xạ từ máy tính, điện từ, điện thoại lên chúng ta từ đó tạo không gian xanh cho ngôi nhà.\r\nKhi trong nhà có cây giữ tiền sẽ tạo cho không gian sống trong gia đình trở nên ấm áp hơn, gần gũi hơn. Bên cạnh đó, cây giữ tiền còn là một món quà dành tặng những người thân, người quan trọng với chúng ta.\r\n', 0, 1),
(34, 'lưỡi hổ', 70000, 10, 'luoiho1.jpg', 'Cây Lưỡi Hổ có tác dụng tốt trong việc trừ tà, xua đuổi ma quỷ và chống lại những điều không may mắn trong cuộc sống. Lá cây mọc thẳng đứng thể hiện sự quyết đoán, ý chí tiến lên của con người. Với dáng vẻ uy nghi từ thân đến ngọn của cây là biểu tượng cho sự uy quyền, danh gia vọng tộc.\r\nHoa Lưỡi Hổ mang đến vẻ đẹp kiêu sa với ý nghĩ cho phong thuỷ rất lớn. Theo quan niệm của người xưa, những người trồng cây Lưỡi Hổ nếu chăm sóc cây ra được hoa, thì may mắn trong năm, không chỉ ở cuộc sống mà còn mang đến nhiều thuận lợi trong công việc, tài chính.\r\nĐể phát huy được tác dụng về phong thuỷ, ta nên tìm đặt vị trí phù hợp cho cây. Vị trí tốt sẽ giúp ta có được may mắn, thuận lợi hơn trong công việc và cuộc sống.\r\n', 1, 1),
(46, 'trauba', 50000, 10, 'traubadevuongvang1.jpg', 'trau ba de vuong', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `price`, `qty`) VALUES
(2, 2, 55000, 1),
(3, 3, 60000, 1),
(4, 4, 700000, 1),
(6, 6, 350000, 1),
(7, 7, 110000, 1),
(8, 8, 60000, 1),
(9, 9, 230000, 1),
(10, 10, 370000, 1),
(11, 11, 990000, 1),
(12, 12, 110000, 1),
(13, 13, 80000, 1),
(15, 15, 55000, 1),
(16, 16, 70000, 1),
(17, 17, 380000, 1),
(18, 18, 760000, 1),
(19, 19, 460000, 1),
(20, 20, 490000, 1),
(21, 21, 50000, 1),
(22, 22, 690000, 1),
(23, 23, 420000, 1),
(24, 24, 30000, 1),
(25, 25, 80000, 1),
(26, 26, 350000, 1),
(27, 27, 65000, 1),
(28, 28, 160000, 1),
(29, 29, 55000, 1),
(30, 30, 90000, 1),
(34, 34, 70000, 1),
(46, 46, 60000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_images` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `product_images`) VALUES
(19, 2, 'ZENBOOK PRO 14 DUO OLED UX8402ZE(1).png'),
(20, 2, 'ZENBOOK PRO 14 DUO OLED UX8402ZE(2).png'),
(21, 2, 'ZENBOOK PRO 14 DUO OLED UX8402ZE(3).png'),
(1, 1, 'luoiho1.jpg'),
(2, 1, 'luoiho2.jpg'),
(3, 1, 'luoiho4.jpg'),
(4, 2, 'cautieutram1'),
(5, 2, 'cautieutram2'),
(0, 0, ''),
(6, 3, 'z4597523565876_7a27f0dcd9139ba5f6db267f24898459.jpg'),
(7, 3, 'z4597523490344_145c1d548b76dd87c9e31b3fe51b6084.jpg'),
(8, 3, 'kiemtien3'),
(9, 4, 'phattainui1'),
(10, 4, 'phattainui2'),
(11, 4, 'phattainui3'),
(0, 1, 'luoiho3.jpg'),
(0, 0, 'kimtien1.jpg'),
(0, 1, 'luoiho4.jpg'),
(0, 0, 'e40e8395682ad3f2c3d1b0cb73381688.jpg'),
(0, 32, 'phattainui1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shiprocket_token`
--

CREATE TABLE `shiprocket_token` (
  `id` int(11) NOT NULL,
  `token` varchar(500) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `shiprocket_token`
--

INSERT INTO `shiprocket_token` (`id`, `token`, `added_on`) VALUES
(1, '', '2023-03-01 00:28:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `added_on`) VALUES
(3, 'Long', '12345', 'longnhanh19@gmail.com', '2023-10-25 04:19:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;
