CREATE DATABASE IF NOT EXISTS `bookstore_db`;
USE `bookstore_db`;

CREATE TABLE IF NOT EXISTS `tbl_books` (
    `book_id` INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each book
    `title` VARCHAR(255) NOT NULL,             -- Title of the book
    `author` VARCHAR(255) NOT NULL,            -- Author of the book
    `isbn` VARCHAR(13) UNIQUE NOT NULL,        -- International Standard Book Number (unique for each book)
    `publisher` VARCHAR(255),                  -- Publisher of the book
    `publication_year` YEAR,                   -- Year the book was published
    `genre` VARCHAR(100),                      -- Genre of the book (e.g., Fiction, Non-Fiction, Science, etc.)
    `language` VARCHAR(50),                    -- Language of the book
    `pages` INT,                               -- Number of pages in the book
    `description` TEXT,                        -- Brief description or summary of the book
    `cover_image` VARCHAR(255),                -- Path or URL to the book's cover image
    `availability` ENUM('available', 'out of stock') DEFAULT 'available', -- Availability status
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Timestamp when the book was added
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Timestamp when the book was last updated
    `stock` INT, -- stock of the book
    `pdf_file` VARCHAR(255) -- url to the ebook pdf file
);

INSERT INTO `tbl_books` (
    `title`, `author`, `isbn`, `publisher`, `publication_year`, `genre`, `language`, `pages`, `description`, `cover_image`, `availability`, `stock`, `pdf_file`
) VALUES
('The Great Gatsby', 'F. Scott Fitzgerald', '9780743273565', 'Scribner', 1925, 'Fiction', 'English', 180, 'A story of love and betrayal in the Jazz Age.', 'images/great_gatsby.jpg', 'available', 50, 'pdfs/great_gatsby.pdf'),
('To Kill a Mockingbird', 'Harper Lee', '9780061120084', 'HarperCollins', 1960, 'Fiction', 'English', 281, 'A powerful story of racial injustice in the American South.', 'images/mockingbird.jpg', 'available', 30, 'pdfs/mockingbird.pdf'),
('1984', 'George Orwell', '9780451524935', 'Signet Classic', 1949, 'Dystopian', 'English', 328, 'A chilling vision of a totalitarian future.', 'images/1984.jpg', 'out of stock', 0, 'pdfs/1984.pdf'),
('Pride and Prejudice', 'Jane Austen', '9780141439518', 'Penguin Classics', 1813, 'Romance', 'English', 279, 'A classic tale of love and misunderstanding.', 'images/pride_prejudice.jpg', 'available', 25, 'pdfs/pride_prejudice.pdf'),
('The Catcher in the Rye', 'J.D. Salinger', '9780316769488', 'Little, Brown and Company', 1951, 'Fiction', 'English', 224, 'A story of teenage rebellion and alienation.', 'images/catcher_rye.jpg', 'available', 40, 'pdfs/catcher_rye.pdf'),
('The Hobbit', 'J.R.R. Tolkien', '9780547928227', 'Houghton Mifflin Harcourt', 1937, 'Fantasy', 'English', 310, 'A fantasy adventure about Bilbo Baggins.', 'images/hobbit.jpg', 'available', 60, 'pdfs/hobbit.pdf'),
('The Alchemist', 'Paulo Coelho', '9780062315007', 'HarperOne', 1988, 'Philosophical Fiction', 'English', 208, 'A story about following your dreams.', 'images/alchemist.jpg', 'available', 35, 'pdfs/alchemist.pdf'),
('The Lord of the Rings', 'J.R.R. Tolkien', '9780544003415', 'Houghton Mifflin Harcourt', 1954, 'Fantasy', 'English', 1178, 'An epic fantasy adventure.', 'images/lotr.jpg', 'available', 20, 'pdfs/lotr.pdf'),
('Harry Potter and the Sorcerer''s Stone', 'J.K. Rowling', '9780590353427', 'Scholastic', 1997, 'Fantasy', 'English', 309, 'The first book in the Harry Potter series.', 'images/hp_sorcerers_stone.jpg', 'available', 100, 'pdfs/hp_sorcerers_stone.pdf'),
('The Da Vinci Code', 'Dan Brown', '9780307474278', 'Anchor', 2003, 'Thriller', 'English', 489, 'A gripping mystery involving art and religion.', 'images/da_vinci_code.jpg', 'available', 45, 'pdfs/da_vinci_code.pdf');