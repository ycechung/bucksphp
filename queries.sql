
insert into products (name, description, image, price) values (
	'Angry Leopard Seal', 
	'Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod.', 
	'http://rlv.zcache.com/leopard_seal_vs_penguin_battle_tshirt-p235094727998853049z7of7_210.jpg', 
	12
)

select * from products order by name

select * from products limit 2

select * from products limit 2, 2

select * from products where id = 6

select id, name from products where id = 6

select id, name from products where price = 12

select * from products where price = 12 and name = "Angry Leopard Seal"

select * from products where price = 12 or name = "Angry Leopard Seal"

# match products with the price 12 whose names end with t-shirt
select * from products where price = 12 and name like "%t-shirt"

# match products with t-shirt in the name
select * from products where name like "%t-shirt%"

select * from products where created_at > (NOW( ) - INTERVAL 1 HOUR)

select * from products where created_at BETWEEN "2012-12-01" AND "2012-12-31"

# update the name of product #6
update products set name = "Angry Leopard Seal T-Shirt" where id = 6

# update the name and description of product #6
update products set name = "Angry Leopard Seal", description = NULL where id = 6

# watch out, this will update all records at once
update products set name = "Angry Leopard Seal", description = NULL

# delete product #6. make sure the where clause is there!
delete from products where id = 6