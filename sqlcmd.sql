create table users (
	id int(10) not null PRIMARY KEY AUTO_INCREMENT ,
    name varchar(64) not null ,
    passwd varchar(32) not null
);
-------------------------------------------------------------------
insert into users (firstname ,lastname, email,uid,pwd) values ('said', 'chbouh' ,'said@hotmail.fr','hadak','12121212') ;
-------------------------------------------------------------------
update users
set name = "al kantri" passwd = "00000" where id = '1'
-------------------------------------------------------------------
delete from users
where id = '1'
-------------------------------------------------------------------
select * from users order by id asc (desc)
----------------------------------------------------------------
create table recipes (
	id int(10) not null AUTO_INCREMENT ,
    user_id int,
    recipe_id int(10) not null ,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
-------------------------------------------------------------------
insert into recipes (user_id,recipe_id) values (121212,123) ;
-------------------------------------------------------------------
INSERT INTO recipes (user_id,recipe_id)
SELECT * FROM (SELECT 10, 1234567 ) AS tmp
WHERE NOT EXISTS (
    SELECT user_id FROM recipes WHERE user_id = '10'
) LIMIT 1;