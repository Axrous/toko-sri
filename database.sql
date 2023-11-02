CREATE TABLE products(
    id int not null auto_increment,
    name varchar(100) not  null,
    price_buy int not null,
    price_sell int not null,
    stock int not null,
    primary key(id)
) ENGINE = InnoDB;

CREATE TABLE expenses(
    id int not null auto_increment,
    date datetime,
    description varchar(255) not null,
    price int not null,
    amount int not null,
    unit varchar(50) not null,
    primary key(id)
) ENGINE = InnoDB;

CREATE TABLE incomes(
    id int not null auto_increment,
    product_id int not null,
    price_buy int not null,
    price_sell int not null,
    amount int not null,
    date datetime,
    primary key(id),
    foreign key(product_id) references products(id)
) ENGINE = InnoDB;