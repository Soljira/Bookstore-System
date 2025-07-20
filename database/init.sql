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

CREATE TABLE IF NOT EXISTS users (
    userID INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (userID)
);

-- Insert Authors
INSERT IGNORE INTO authorTable (authorID, authorName) VALUES
(1, 'Jane Austen'),
(2, 'Mark Twain'),
(3, 'Charles Dickens'),
(4, 'Leo Tolstoy'),
(5, 'J.K. Rowling'),
(6, 'George Orwell'),
(7, 'Agatha Christie'),
(8, 'F. Scott Fitzgerald'),
(9, 'Ernest Hemingway'),
(10, 'Haruki Murakami');

-- Insert Publishers
INSERT IGNORE INTO publisherTable (publisherID, publisherName, publisherAddress) VALUES
(1, 'Penguin Books', '123 Penguin Street'),
(2, 'HarperCollins', '456 Harper Ave'),
(3, 'Random House', '789 Random Blvd'),
(4, 'Simon & Schuster', '321 Simon Lane'),
(5, 'Macmillan', '654 Macmillan Road');

-- Insert Books
INSERT IGNORE INTO bookTable (bookID, bookTitle, bookAuthor, bookPublisher, bookPublicationDate, bookGenre, bookQuantity, bookPrice) VALUES
(1, 'Pride and Prejudice', 1, 1, '1813-01-28', 'Romance', 10, 9.99),
(2, 'Adventures of Huckleberry Finn', 2, 2, '1884-12-10', 'Adventure', 5, 12.50),
(3, 'Great Expectations', 3, 3, '1861-08-01', 'Drama', 8, 11.75),
(4, 'War and Peace', 4, 4, '1869-01-01', 'Historical', 3, 15.00),
(5, 'Harry Potter and the Sorcerer\'s Stone', 5, 5, '1997-06-26', 'Fantasy', 20, 20.00),
(6, '1984', 6, 1, '1949-06-08', 'Dystopian', 15, 13.99),
(7, 'Murder on the Orient Express', 7, 2, '1934-01-01', 'Mystery', 7, 10.99),
(8, 'The Great Gatsby', 8, 3, '1925-04-10', 'Classic', 9, 14.25),
(9, 'The Old Man and the Sea', 9, 4, '1952-09-01', 'Fiction', 6, 9.50),
(10, 'Kafka on the Shore', 10, 5, '2002-09-12', 'Magical Realism', 4, 17.80);

-- Insert Orders
INSERT IGNORE INTO orderTable (orderID, orderDate) VALUES
(1, '2024-01-01'),
(2, '2024-01-15'),
(3, '2024-02-01'),
(4, '2024-02-20'),
(5, '2024-03-10'),
(6, '2024-03-25'),
(7, '2024-04-05'),
(8, '2024-04-18'),
(9, '2024-05-02'),
(10, '2024-05-15');

-- Insert Order Items (Junction table: orderItemTable)
INSERT IGNORE INTO orderItemTable (orderID, bookID, quantity, unitPrice) VALUES
(1, 1, 2, 9.99),
(1, 2, 1, 12.50),
(2, 3, 3, 11.75),
(2, 4, 1, 15.00),
(3, 5, 2, 20.00),
(3, 6, 1, 13.99),
(4, 7, 4, 10.99),
(4, 8, 1, 14.25),
(5, 9, 2, 9.50),
(5, 10, 1, 17.80),
(6, 1, 1, 9.99),
(7, 2, 2, 12.50),
(8, 3, 1, 11.75),
(8, 4, 3, 15.00),
(9, 5, 1, 20.00),
(9, 6, 2, 13.99),
(10, 7, 1, 10.99),
(10, 8, 1, 14.25);


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
