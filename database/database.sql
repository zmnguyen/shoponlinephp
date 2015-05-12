DROP database IF EXISTS shoponlineShiver;
CREATE DATABASE shoponlineShiver;

USE shoponlineShiver;

DROP TABLE IF EXISTS TBL_PRODUCT;
CREATE TABLE TBL_PRODUCT(
	PRODUCT_id varchar(20) NOT NULL,
    PRODUCT_name nvarchar(50) NOT NULL,
    PRODUCT_decription nvarchar(3000) NOT NULL,
    PRODUCT_img varchar(50),
    PRODUCT_meterial nvarchar(100),
    PRODUCT_producer nvarchar(100),
    PRODUCT_supplier nvarchar(100),
    PRODUCT_import double,
    PRODUCT_export double,
    PRODUCT_amount int,
    PRODUCT_status bit default 1,
    CATE_id int,
    PRIMARY KEY(PRODUCT_id)
);

DROP TABLE IF EXISTS TBL_CATEGORIES;
CREATE TABLE TBL_CATEGORIES(
	CATE_id int AUTO_INCREMENT,
    CATE_name nvarchar(50) NOT NULL,
    CATE_parent int,
    PRIMARY KEY(CATE_id)
);

DROP TABLE IF EXISTS TBL_IMAGE;
CREATE TABLE TBL_IMAGE
(
	IMAGE_id varchar(20) NOT NULL,
    IMAGE_patch nvarchar(50) NOT NULL,
    PRODUCT_id varchar(20) NOT NULL,
    PRIMARY KEY(IMAGE_id)
);

DROP TABLE IF EXISTS TBL_USER;
CREATE TABLE TBL_USER(
	USER_id varchar(20),
    USER_name nvarchar(50) NOT NULL,
    USER_fullname nvarchar(100),
    USER_password nvarchar(6535) NOT NULL,
    USER_encript nvarchar(6535) NOT NULL,
    USER_email nvarchar(100), 
    USER_status bit default 1,
    ROLE_id varchar(10),
    PRIMARY KEY(USER_id)
);

DROP TABLE IF EXISTS TBL_ROLE;
CREATE TABLE TBL_ROLE(
	ROLE_id varchar(10) NOT NULL,
    ROLE_name nvarchar(50) NOT NULL,
    PRIMARY KEY(ROLE_id)
);

DROP TABLE IF EXISTS TBL_ORDER;
CREATE TABLE TBL_ORDER(
	ORDER_id varchar(50) NOT NULL,
    ORDER_maker nvarchar(200),
    ORDER_to nvarchar(500) NOT NULL,
    ORDER_comment nvarchar(1000),
    ORDER_date date NOT NULL,
    ORDER_total double,
    ORDER_status bit default 0,
    USER_id varchar(20),
    PRIMARY KEY(ORDER_id)
);

DROP TABLE IF EXISTS TBL_ORDERDETAIL;
CREATE TABLE TBL_ORDERDETAIL(
	DETAIL_id varchar(20) NOT NULL,
    DETAIL_amount int NOT NULL,
    DETAIL_total double NOT NULL,
    ORDER_id varchar(13) NOT NULL,
    PRODUCT_id varchar(20) NOT NULL,
    PRIMARY KEY(DETAIL_id)
);

DROP TABLE IF EXISTS TBL_IMG;
CREATE TABLE TBL_IMG(
	IMG_id int AUTO_INCREMENT,
    IMG_name nvarchar(100) not null,
    PRIMARY KEY(IMG_id)
);

DROP TABLE IF EXISTS TBL_EVENT;
CREATE TABLE TBL_EVENT(
	EVENT_id int AUTO_INCREMENT,
    EVENT_name nvarchar(200),
    EVENT_img nvarchar(200),
    EVENT_content nvarchar(2000),
    EVENT_discount int NOT NULL,
    EVENT_from date not null,
    EVENT_to date not null,
    PRIMARY KEY(EVENT_id)
);

DROP TABLE IF exists TBL_EVENTDETAIL;
CREATE TABLE TBL_EVENTDETAIL(
	EVENT_id int not null,
    CATE_id int NOT NULL,
    EVENTDETAIL_date date,
    
    PRIMARY KEY(EVENT_id, CATE_id)
);

DROP TABLE IF EXISTS TBL_MESSAGE;
CREATE TABLE TBL_MESSAGE(
	MESSAGE_id int auto_increment,
    MESSAGE_sender nvarchar(100) NOT NULL,
    MESSAGE_content nvarchar(20000) NOT NULL,
    MESSAGE_date date,
    MESSAGE_status bit default false,
	primary key(MESSAGE_id)
);

ALTER TABLE TBL_PRODUCT
ADD 
CONSTRAINT FK_TBLPRODUCT_TBL_CATEGORIES foreign key(CATE_id) references TBL_CATEGORIES(CATE_id);

ALTER TABLE TBL_IMAGE
ADD
CONSTRAINT FK_TBLIMAGE_TBLPRODUCT foreign key(PRODUCT_id) references TBL_PRODUCT(PRODUCT_id);

ALTER TABLE TBL_USER
ADD
CONSTRAINT FK_TBLUSER_TBLROLE foreign key(ROLE_id) references TBL_ROLE(ROLE_id);

ALTER TABLE TBL_ORDER
ADD
CONSTRAINT FK_TBLORDER_TBLUSER foreign key(USER_id) references TBL_USER(USER_id);

ALTER TABLE TBL_ORDERDETAIL
ADD CONSTRAINT FK_TBLORDERDETAIL_TBLORDER foreign key(ORDER_id) references TBL_ORDER(ORDER_id),
ADD CONSTRAINT FK_TBLORDERDETAIL_TBLPRODUCT foreign key(PRODUCT_id) references TBL_PRODUCT(PRODUCT_id);

ALTER TABLE TBL_EVENTDETAIL
ADD constraint FK_TBLEVENTDETAIL_TBLEVENT foreign key(EVENT_id) references TBL_EVENT(EVENT_id),
ADD constraint FK_TBLEVENTDETAIL_TBLCATE foreign key(CATE_id) references TBL_CATEGORIES(CATE_id)


DELIMITER $$
CREATE PROCEDURE usp_TBLCATEGORIES_ADD(in cateid int unsigned, in catename nvarchar(50), in cateparent int)
begin
	INSERT INTO TBL_CATEGORIES (CATE_id, CATE_name, CATE_parent) values(cateid, catename, cateparent);
end$$

CREATE PROCEDURE usp_TBLCATEGORIES_UPDATE(in cateid int unsigned, in catename nvarchar(50), in cateparent int)
begin
	UPDATE TBL_CATEGORIES 
    SET
		CATE_name = catename,
        CATE_parent = cateparent
    where CATE_id = cateid;
end$$

CREATE PROCEDURE usp_TBLCATEGORIES_DELETE(in cateid int)
begin
	DELETE FROM shoponlineshiver.tbl_categories
	WHERE CATE_id = cateid;
end$$

CREATE PROCEDURE usp_TBLIMAGE_ADD(in imgid int, in imgpath nvarchar(50), in productid varchar(20))
begin
	INSERT INTO shoponlineshiver.tbl_image values(imgid,imgpath,productid);
end$$

CREATE PROCEDURE usp_TBLIMAGE_DELETE(in imgid int)
begin
	DELETE FROM shoponlineshiver.tbl_image
	WHERE IMAGE_id = imgid;
end$$

CREATE PROCEDURE usp_TBLPRODUCT_ADD(in productname nvarchar(50), in productimg nvarchar(50), in cateid varchar(10))
begin
	declare countproduct int;
    declare productid nvarchar(20);
    
    set countproduct = (select count(*) from tbl_product where CATE_id = 1);
    set productid = concat(cateid,"-", RIGHT(concat("00000", (countpproduct+1)),6));
    #set productid = cateid + '-' + RIGHT('00000' + (countproduct +1), 6);
    
	INSERT INTO shoponlineshiver.tbl_product
	(PRODUCT_id, PRODUCT_name, PRODUCT_img, CATE_id)
	VALUES
	(productid, productname, productimg, cateid);

end$$

CREATE PROCEDURE usp_TBLPRODUCT_UPDATE(in id varchar(20) ,in productname nvarchar(50), in productimg nvarchar(50), in cateid varchar(10))
begin
	update tbl_product set PRODUCT_name = productname, PRODUCT_img = productimg, CATE_id = cateid where PRODUCT_id = id;
end$$

CREATE PROCEDURE usp_TBLPRODUCT_DELETE(in productid varchar(20))
begin
	UPDATE shoponlineshiver.tbl_product set PRODUCT_status = 0 where PRODUCT_id = productid;
end$$

CREATE PROCEDURE usp_TBLROLE_ADD(in roleid varchar(10), in rolename nvarchar(50))
begin
	INSERT INTO tbl_role values(roleid, rolename);
end$$

CREATE PROCEDURE usp_TBLROLE_UPDATE(in roleid varchar(10), in rolename nvarchar(50))
begin
	UPDATE tbl_role set ROLE_name = rolename where ROLE_id = roleid;
end$$

CREATE PROCEDURE usp_TBLROLE_DELETE(in roleid varchar(10))
begin
	DELETE FROM tbl_role where ROLE_id = roleid;
end$$

CREATE PROCEDURE usp_TBLUSER_ADD (in name nvarchar(50), in fullname nvarchar(100), in password nvarchar(6535), in encrypt nvarchar(6535), in email nvarchar(100), in role varchar(10))
begin
	declare id varchar(20); declare count int;
	set count = (select count(*) from tbl_user where ROLE_id = role);
    set id = concat(role,"-", RIGHT( concat("00000",convert((count +1),char)), 6));
    
	insert into tbl_user values(id, name, fullname, password, encrypt, email, role);
end$$

CREATE PROCEDURE usp_TBLUSER_UPDATE(in id varchar(20), in fullname nvarchar(100), in password nvarchar(6535), in encrypt nvarchar(6535), in email nvarchar(100), in role varchar(10))
begin
	UPDATE tbl_user 
    set 
		USER_fullname = fullname,
        USER_password = password,
        USER_encript = encrypt,
        USER_email = email,
        ROLE_id = role
	where USER_id = id;
end$$

CREATE PROCEDURE usp_TBLUSER_DELETE(in id varchar(20))
begin
	UPDATE TBL_USER SET USER_status = 0 where USER_id = id;
end$$

CREATE PROCEDURE usp_TBLORDER_ADD(in maker nvarchar(200), in address nvarchar(500), in comment nvarchar(1000),in total double, in userid varchar(20))
begin
	declare count int; declare orderid varchar(13);
    set count = (select count(*) from tbl_order where ORDER_date = curdate());
    set orderid = (concat("HD-",year(curdate()),month(curdate()),day(curdate()),"-",RIGHT(concat("00000",(1 + 1)),6)));
    
    insert into tbl_order(ORDER_id, ORDER_maker, ORDER_to, ORDER_to, ORDER_comment, ORDER_date, ORDER_total, USER_id) values(orderid, maker, address, comment, curdate(), total, userid);
end$$

