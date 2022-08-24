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
	
	password varchar not null,
	
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

INSERT INTO Users (fname,lname,email,password,is_admin) VALUES("Jacob","O'Leary","admin@cooladmin.com","admin",true);
