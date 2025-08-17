<?php
require_once 'includes/book_operations.php';
$books = getAllBooks();
$error = $books === false ? "Error loading books" : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Table - Online Library</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <header>
        <h1>Online Library</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="books.php" class="active">Books</a></li>
                <li><a href="upload.html">Upload Books</a></li>
                <li><a href="Edit Books.html">Edit Books</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Books Table</h2>
        
        <?php if ($error): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php else: ?>
            <div class="search-sort-container">
                <div class="search-container">
                    <input type="text" id="table-search" placeholder="Search books...">
                    <button id="table-search-button">Search</button>
                </div>
                <div class="sort-container">
                    <label for="sort-select">Sort by:</label>
                    <select id="sort-select">
                        <option value="title">Title</option>
                        <option value="author">Author</option>
                    </select>
                    <button id="sort-direction">↑</button>
                </div>
            </div>

            <table class="books-table" id="books-table">
                <thead>
                    <tr>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="books-table-body">
                    <?php if (empty($books)): ?>
                        <tr>
                            <td colspan="4" class="no-books">No books found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($books as $book): ?>
                        <tr>
                            <td><img src="assets/book-covers/<?php echo htmlspecialchars($book['image_path']); ?>" 
                                    alt="<?php echo htmlspecialchars($book['title']); ?>" 
                                    onerror="handleImageError(this)"></td>
                            <td><span class="editable-content" data-type="title" data-id="<?php echo $book['id']; ?>">
                                <?php echo htmlspecialchars($book['title']); ?></span></td>
                            <td><span class="editable-content" data-type="author" data-id="<?php echo $book['id']; ?>">
                                <?php echo htmlspecialchars($book['author']); ?></span></td>
                            <td>
                                <div class="table-actions">
                                    <a href="book-details.php?id=<?php echo $book['id']; ?>" class="view-button">View</a>
                                    <a href="reader.php?id=<?php echo $book['id']; ?>" class="read-button">Read</a>
                                    <a href="download.php?id=<?php echo $book['id']; ?>" class="download-button">Download</a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; <span id="current-year"></span> Online Library</p>
    </footer>

    <script src="scripts/main.js"></script>
</body>
</html> 