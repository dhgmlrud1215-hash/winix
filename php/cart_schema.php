<?php
function ensure_cart_tables($connect) {
    mysqli_query($connect, 'set names utf8');

    $productsSql = "CREATE TABLE IF NOT EXISTS products (
        product_id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        model VARCHAR(50) NOT NULL,
        price INT NOT NULL,
        image VARCHAR(255) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

    $cartSql = "CREATE TABLE IF NOT EXISTS cart (
        cart_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id VARCHAR(30) NOT NULL,
        product_id INT NOT NULL,
        quantity INT NOT NULL DEFAULT 1,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        UNIQUE KEY unique_user_product (user_id, product_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

    mysqli_query($connect, $productsSql);
    mysqli_query($connect, $cartSql);

    $seedSql = "INSERT INTO products (product_id, name, model, price, image) VALUES
        (1, '타워프라임 플러스 실버', 'ATTM115-MSK', 409000, '../img_airclick/air_click.png'),
        (2, '타워프라임 플러스 화이트', 'ATTM115-MWK', 490000, '../img_air/air_2.png'),
        (3, '타워엣지 컴팩트', 'AT5M200-MWK', 129000, '../img_air/air_3.png'),
        (4, '타워엣지 화이트', 'AT8E430-MWK', 199000, '../img_air/air_4.png'),
        (5, '타워엣지 실버', 'AT8E430-MSK', 199000, '../img_air/air_5.png'),
        (6, '제로S 라이트', 'AZSE430-LMK', 129000, '../img_air/air_6.png'),
        (7, '타워프라임', 'APRM833-JWK', 399000, '../img_air/air_7.png'),
        (8, '제로S', 'AZSE430-JWK', 209000, '../img_air/air_8.png'),
        (9, '타워프라임 플러스 35평형', 'ATTG115-MGK', 499000, '../img_air/air_9.png'),
        (10, '위닉스 뽀송 12L', 'DXTE120-KWK', 259000, '../img_mainbest/best1.png')
        ON DUPLICATE KEY UPDATE
            name = VALUES(name),
            model = VALUES(model),
            price = VALUES(price),
            image = VALUES(image)";
    mysqli_query($connect, $seedSql);
}
?>