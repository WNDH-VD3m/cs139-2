DROP TABLE User;
CREATE TABLE User (
  UserID INTEGER PRIMARY KEY,
  Name TEXT,
  Email TEXT,
  UidUsers TEXT,
  Password TEXT,
  Salt TEXT
);

DROP TABLE List;
CREATE TABLE List (
  ListID INTEGER PRIMARY KEY,
  UserID INTEGER,
  Name TEXT,
  DateCreated DATE
);

DROP TABLE ListItems;
CREATE TABLE ListItems(
  ItemID INTEGER PRIMARY KEY,
  ListID INTEGER,
  Name TEXT,
  Content TEXT,
  Done BOOLEAN
);
