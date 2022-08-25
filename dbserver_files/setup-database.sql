CREATE TABLE Houses (

  house_id int(255) AUTO_INCREMENT,

  bedrooms int(255) not null,
  
  beds int(255) not null,
  
  guest_limit int(255) not null,
  
  bathrooms int(255) not null,
  
  price_per_day decimal(65,2) not null,
  
  cleaning_fee int(255) not null,
  
  description varchar(600) not null,
  
  city varchar(100) not null,
  
  country varchar(100) not null,
  
  address varchar(150) not null,
  
  approved bool not null,

  PRIMARY KEY (house_id)

);


CREATE TABLE Users (
	users_id int(255) AUTO_INCREMENT,
	
	fname varchar(255) not null,
	
	lname varchar(255) not null,
	
	email varchar(255) not null,
	
	pass_word varchar(255) not null,
	
	is_admin bool,
	
	PRIMARY KEY (users_id)
);

CREATE TABLE Booking (
	booking_id int(255) AUTO_INCREMENT,
	
	house_id int(255),
	
	check_in_date date not null,
	
	days int(255) not null,
	
	users_id int(255),
	
	PRIMARY KEY (booking_id),
	
	FOREIGN KEY (house_id) references Houses(house_id),
	
	FOREIGN KEY (users_id) references Users(users_id)
	
);

INSERT INTO Users (fname,lname,email,pass_word,is_admin) VALUES("Jacob","O'Leary","admin@cooladmin.com","admin",true);
INSERT INTO Houses (bedrooms,beds,guest_limit,bathrooms,price_per_day,cleaning_fee,description,city,country,address,approved) VALUES(4,5,6,2,167.00,20,"Nice warm house with lots of sun","Dunedin","New Zealand","18 Turner St",true);
INSERT INTO Houses (bedrooms,beds,guest_limit,bathrooms,price_per_day,cleaning_fee,description,city,country,address,approved) VALUES(5,10,15,1,136,26,"lovely location with shops nearby","Cape Town","USA","318 Stuart St",true);
INSERT INTO Houses (bedrooms,beds,guest_limit,bathrooms,price_per_day,cleaning_fee,description,city,country,address,approved) VALUES(3,6,9,1,176,30,"great place to get away to","London","Italy","349 Stuart St",true);
INSERT INTO Houses (bedrooms,beds,guest_limit,bathrooms,price_per_day,cleaning_fee,description,city,country,address,approved) VALUES(3,6,9,2,186,30,"a house with a bed and bathroom :)","Dunedin","USA","59 Union St",true);
INSERT INTO Houses (bedrooms,beds,guest_limit,bathrooms,price_per_day,cleaning_fee,description,city,country,address,approved) VALUES(4,8,12,2,167,30,"warm house with free wifi","Chicago","USA","212 Oak St",true);

INSERT INTO Houses (bedrooms,beds,guest_limit,bathrooms,price_per_day,cleaning_fee,description,city,country,address,approved) VALUES(1,2,3,3,216,31,"Sunny with a great view with plenty of room","Chicago","Timbucktoo","51 Spider St",false);
INSERT INTO Houses (bedrooms,beds,guest_limit,bathrooms,price_per_day,cleaning_fee,description,city,country,address,approved) VALUES(6,12,18,2,186,30,"a house with a bed and bathroom :)","Chicago","New Zealand","54 Stuart St",false);
INSERT INTO Houses (bedrooms,beds,guest_limit,bathrooms,price_per_day,cleaning_fee,description,city,country,address,approved) VALUES(1,2,3,2,176,36,"lovely location with shops nearby","Cape Town","USA","456 Cherry St",false);
INSERT INTO Houses (bedrooms,beds,guest_limit,bathrooms,price_per_day,cleaning_fee,description,city,country,address,approved) VALUES(5,5,7,3,196,39,"warm house with free wifi","Dunedin","Australia","124 Cherry St",false);
INSERT INTO Houses (bedrooms,beds,guest_limit,bathrooms,price_per_day,cleaning_fee,description,city,country,address,approved) VALUES(3,5,5,1,127.00,15,"Nice house","Queenstown","Australia","112 Joe St",false);
