-- Active: 1752857174417@@127.0.0.1@3306@bookstoreDB
CREATE DATABASE IF NOT EXISTS bookstoreDB;
USE bookstoreDB;


CREATE TABLE IF NOT EXISTS testTable (
    authorID INT NOT NULL,
    authorName VARCHAR(100) NOT NULL,
    PRIMARY KEY (authorID)
);

CREATE TABLE IF NOT EXISTS authorTable (
    authorID INT NOT NULL,
    authorName VARCHAR(100) NOT NULL,
    PRIMARY KEY (authorID)
);

CREATE TABLE IF NOT EXISTS publisherTable (
    publisherID INT NOT NULL,
    publisherName VARCHAR(100) NOT NULL,
    publisherAddress VARCHAR(255),
    PRIMARY KEY (publisherID)
);

CREATE TABLE IF NOT EXISTS bookTable (
    bookID INT NOT NULL,
    bookTitle VARCHAR(200) NOT NULL,
    bookAuthor INT NOT NULL,
    bookPublisher INT,
    bookPublicationDate DATE,
    bookGenre VARCHAR(50),
    bookQuantity INT,
    bookPrice DECIMAL(10,2),
    PRIMARY KEY (bookID),
    FOREIGN KEY (bookAuthor) REFERENCES authorTable(authorID),
    FOREIGN KEY (bookPublisher) REFERENCES publisherTable(publisherID)
);

CREATE TABLE IF NOT EXISTS orderTable (
    orderID INT PRIMARY KEY,
    orderDate DATE NOT NULL DEFAULT (CURRENT_DATE)
);

-- Junction table (SOLUTION para dun sa 'list' in one column)
CREATE TABLE IF NOT EXISTS orderItemTable (
    orderID INT NOT NULL,
    bookID INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    unitPrice DECIMAL(10,2),
    PRIMARY KEY (orderID, bookID),
    FOREIGN KEY (orderID) REFERENCES orderTable(orderID),
    FOREIGN KEY (bookID) REFERENCES bookTable(bookID)
);



-- INSERT INTO authorTable (authorID, name, biography) VALUES
-- (1, 'Hailey Mae Casem', 'Basketballerist'),
-- (2, 'Rofer Savella', 'Developed HTML/CSS/JavaScript'),
-- (3, 'Leeian Lacorte', 'Award-winning poet'),
-- (4, 'Chocen Peronilla', 'White hat hacker'),
-- (5, 'Mark Louie Soriano', 'Decorated Philippine General');
-- 
-- INSERT INTO publisherTable (publisherID, name, address) VALUES
-- (1, 'Mendavia Publishing', 'Pangasinan'),
-- (2, 'Penguin Books', '20 Vauxhall Bridge Road, London, England, SW1V 2SA'),
-- (3, 'Benitez Books', 'Pangasinan'),
-- (4, 'Elevazo House', 'Pangasinan'),
-- (5, 'Soberano Media', 'Japan');
-- 
-- INSERT INTO bookTable (bookID, title, author, publisher, publicationDate, genre, quantity, price) VALUES
-- (1, 'Basketball 101', 1, 1, '2020-09-15', 'Nonfiction', 12, 200.5),
-- (2, 'Applying the OSI Model', 2, 2, '2018-05-22', 'Nonfiction', 7, 800),
-- (3, 'Harana', 3, 3, '2021-11-03', 'Poetry', 20, 150.3),
-- (4, 'How to infiltrate the Philippine National Bank', 4, 4, '2019-02-10', 'Nonfiction', 5, 1000),
-- (5, 'Revisiting the Moro conflict', 5, 5, '2022-07-29', 'Autobiography', 15, 800);
-- 
-- INSERT INTO orderTable (orderID, orderDate, orderedItems) VALUES
-- (1, '2025-07-11', '1,2'),
-- (2, '2025-07-12', '3'),
-- (3, '2025-07-13', '2,4'),
-- (4, '2025-07-14', '1,3,4'),
-- (5, '2025-07-15', '5');
