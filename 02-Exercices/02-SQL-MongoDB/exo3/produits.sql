DROP DATABASE IF EXISTS PRODUITS;

CREATE DATABASE PRODUITS;

USE PRODUITS;

CREATE TABLE customers(
    cus_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    cus_lastname VARCHAR(50),
    cus_firstname VARCHAR(50),
    cus_adress VARCHAR(50),
    cus_zipcode VARCHAR(50),
    cus_city VARCHAR(50),
    cus_mail VARCHAR(50),
    cus_phone VARCHAR(50),
    cus_password VARCHAR(50)

)ENGINE=INNODB;


CREATE TABLE orders(
    ord_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ord_order_date DATE,
    ord_payment_date DATE,
    ord_ship_date DATE,
    ord_reception_date DATE,
    ord_status_date INT,

    ord_cus_id INT,

    FOREIGN KEY (ord_cus_id) REFERENCES customers(cus_id)

)ENGINE=INNODB;


CREATE TABLE categories(
    cat_id INT PRIMARY KEY AUTO_INCREMENT,
    cat_name VARCHAR(50),

    cat_parent_id INT,

    FOREIGN KEY (cat_parent_id) REFERENCES categories(cat_id)

)ENGINE=INNODB;


CREATE TABLE suppliers(
    sup_id INT PRIMARY KEY AUTO_INCREMENT,
    sup_name VARCHAR(50),
    sup_city VARCHAR(50),
    sup_adresse VARCHAR(50),
    sup_zipcode VARCHAR(50),
    sup_contact VARCHAR(50),
    sup_phone VARCHAR(50),
    sup_mail VARCHAR(50),

    sup_countries_id INT,

    FOREIGN KEY (sup_countries_id) REFERENCES suppliers(sup_id)

)ENGINE=INNODB;


CREATE TABLE products(
    pro_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    pro_price INT,
    pro_ref VARCHAR(50),
    pro_name VARCHAR(50),
    pro_desc VARCHAR(50),
    pro_publish INT,   
    pro_picture VARCHAR(50),

    pro_cat_id INT,
    pro_sup_id INT,

    FOREIGN KEY (pro_cat_id) REFERENCES categories(cat_id),
    FOREIGN KEY (pro_sup_id) REFERENCES suppliers(sup_id)

)ENGINE=INNODB;


CREATE TABLE orders_details(
    ode_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ode_unit_price INT,
    ode_quantity INT,

    ode_ord_id INT,
    ode_pro_id INT,
    
    FOREIGN KEY (ode_ord_id) REFERENCES orders(ord_id),
    FOREIGN KEY (ode_pro_id) REFERENCES products(pro_id)

)ENGINE=INNODB;