-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2024 at 04:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_title`) VALUES
(2, 'Moda'),
(3, 'javascripts'),
(11, 'ssss'),
(14, 'PHP');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` varchar(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(225) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(225) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(2, '1', 'awab', 'awab@gmail.com', 'this is comment', 'Approved', '2024-08-20'),
(7, '1', 'mohammed tarek', 'moh.tarek.dev@gmail.com', 'this is third  comment', 'Approved', '2024-08-20'),
(11, '5', 'mohammed tarek', 'bajaxykoc@mailinator.com', 'iwish is to be good', 'Approved', '2024-08-20'),
(16, '9', 'mohammed tarek', 'moh.tarek.dev@gmail.com', 'repudiandae consequuntur voluptatum laborum\r\nnumquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium\r\noptio, eaque rerum! Provident similique accusantium nemo autem. Veritatis\r\nobcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam\r\nnihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,\r\ntenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,\r\nquia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos', 'unapproved', '2024-09-02'),
(19, '10', 'toqe@mailinator.com', 'zazudacir@mailinator.com', 'Est quisquam tempore', 'Approved', '2024-09-02'),
(22, '9', 'riweb@mailinator.com', 'mycu@mailinator.com', 'Inventore culpa qui', 'Approved', '2024-09-02'),
(28, '9', 'mypojo@mailinator.com', 'natikagot@mailinator.com', 'Pariatur Eiusmod qu', 'Approved', '2024-09-02'),
(33, '8', 'mohammed tarek', 'bajaxykoc@mailinator.com', 'dassdadadadadad', 'Approved', '2024-09-02');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_cat_id` int(3) NOT NULL,
  `post_title` varchar(225) NOT NULL,
  `post_author` varchar(225) NOT NULL,
  `post_user` varchar(225) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(225) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(225) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_cat_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(8, 3, 'Dolorem quod veritat', 'Awab', '', '2024-09-02', 'Ellipse 1 (4).png', '<span style=\"font-family: &quot;Comic Sans MS&quot;;\">Duis anim cupidatat .</span>', 'post1 , post2', 0, 'published', 0),
(9, 11, 'post 2', 'ADMIN123', '', '2024-09-02', 'Group 1171276232 (1).png', '<span style=\"color: rgb(248, 248, 242); font-family: Consolas, Monaco, &quot;Andale Mono&quot;, &quot;Ubuntu Mono&quot;, monospace; white-space: pre; background-color: rgb(39, 40, 34);\"><span style=\"font-family: &quot;Comic Sans MS&quot;;\">Lorem ipsum dolor sit</span><span style=\"font-family: &quot;Comic Sans MS&quot;;\"> </span><span style=\"font-family: &quot;Comic Sans MS&quot;;\">amet consectetur adipisicing elit. Maxime mollitia,\r\n</span>molestiae quas vel sint commodi</span>', 'post1 , post2', 0, 'published', 0),
(10, 14, 'post 3', 'lyhaci', '', '2024-09-02', 'Rectangle 4 (1).png', '    <p><font face=\"Consolas, Monaco, Andale Mono, Ubuntu Mono, monospace\" color=\"#000000\"><span style=\"white-space: pre; font-family: Impact; background-color: rgb(206, 198, 206);\">repudiandae consequuntur voluptatum laborum</span></font></p><p><font face=\"Consolas, Monaco, Andale Mono, Ubuntu Mono, monospace\" color=\"#000000\"><span style=\"white-space: pre; font-family: Impact; background-color: rgb(206, 198, 206);\">numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium</span></font></p><p><font face=\"Consolas, Monaco, Andale Mono, Ubuntu Mono, monospace\" color=\"#000000\"><span style=\"white-space: pre; font-family: Impact; background-color: rgb(206, 198, 206);\">optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis</span></font></p><p><font face=\"Consolas, Monaco, Andale Mono, Ubuntu Mono, monospace\" color=\"#000000\"><span style=\"white-space: pre; font-family: Impact; background-color: rgb(206, 198, 206);\">obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam</span></font></p><p><font face=\"Consolas, Monaco, Andale Mono, Ubuntu Mono, monospace\" color=\"#000000\"><span style=\"white-space: pre; font-family: Impact; background-color: rgb(206, 198, 206);\">nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,</span></font></p><p><font face=\"Consolas, Monaco, Andale Mono, Ubuntu Mono, monospace\" color=\"#000000\"><span style=\"white-space: pre; font-family: Impact; background-color: rgb(206, 198, 206);\">tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,</span></font></p><p><font face=\"Consolas, Monaco, Andale Mono, Ubuntu Mono, monospace\" color=\"#000000\"><span style=\"white-space: pre; font-family: Impact; background-color: rgb(206, 198, 206);\">quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos </span></font></p>', 'post1 , post2 , post3', 0, 'published', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_firstname` varchar(225) NOT NULL,
  `user_lastname` varchar(225) NOT NULL,
  `user_email` varchar(225) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`) VALUES
(1, 'Awab', '123', 'Awab', 'Mohammed', 'awab@gmail.com', 'WhatsApp Image 2024-08-28 at 9.54.41 PM.jpeg', 'Admin'),
(5, 'lyhaci', 'Pa$$w0rd!', 'Erich', 'Roth', 'maxuweci@mailinator.com', 'logo-png-1024x436.png', 'Admin'),
(38, 'ADMIN123', '$2y$10$65nYkSCUsW9CoVzK7SYfJe396', 'mohammed nasr', 'nasr', 'ADMIN123@gmail.com', 'Ellipse 1.png', 'Admin'),
(39, 'admin2', '$2y$12$t1ru6SGIvUMQlqm6yxKF5OWJN', '', '', 'admin2@gmail.com', '', 'subscriber');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(3) NOT NULL,
  `session` varchar(225) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(7, '$session', 0),
(8, '$session', 0),
(9, '$session', 0),
(10, '$session', 0),
(11, '$session', 0),
(12, '$session', 0),
(13, '$session', 0),
(14, '$session', 0),
(15, '$session', 0),
(16, '$session', 0),
(17, 'hv0h581ah8848472oscolc94s4', 1725361188),
(18, '$session', 0),
(19, '$session', 0),
(20, '', 1725361188),
(21, 'r31v3a72idapmj4sjuo8es2hij', 1725369013);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
