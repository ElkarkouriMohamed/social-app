# Social App
A social networking application built with PHP, MySQL, HTML, CSS, JS, and jQuery

## Overview
This is a simple social application that allows users to create an account, post content, interact with other users, send friend requests, and have a messaging/chat system. The app uses **PHP**, **MySQL**, **HTML**, **CSS**, **JavaScript**, and **jQuery**.

## Features

### User Authentication
* Users can sign up and sign in to their accounts
* Passwords are securely stored in the database

### Create Posts
* Users can create posts and include images
* Posts can have content, and images attached

### Post Interaction
* Users can view posts from other users
* Each post has its own comment section where users can comment

### Friend Requests
* Users can send friend requests to others
* Once the request is accepted, the user is added to the friends list
* Only friends can send private messages

### Real-Time Messaging
* Users can send messages to their friends
* The messaging system works like real-time chat

## Technologies Used

### Frontend
* HTML
* CSS
* JavaScript
* jQuery

### Backend
* PHP

### Database
* MySQL

## Installation

### Prerequisites
* A web server (e.g., XAMPP, WAMP, or any server supporting PHP)
* MySQL database server

### Steps

1. **Clone the Repository**:
```bash
git clone https://github.com/ElkarkouriMohamed/social-app.git
```

2. **Set Up the Database**:
   * Create a MySQL database
   * Import the provided `chat.sql` file to set up the required tables and relationships

   Example:
   ```bash
   mysql -u your-username -p your-database-name < chat.sql
   ```

3. **Configure Database Connection**:
   * Edit the database connection details in the PHP configuration file (e.g., `db_connect.php`) with your MySQL server credentials

   Example:
   ```php
   $db_host = 'localhost';
   $db_user = 'your-username';
   $db_password = 'your-password';
   $db_name = 'your-database-name';
   ```

4. **Run the Application**:
   * Place the project files in the web server's root directory (e.g., `htdocs` in XAMPP)
   * Access the app via `http://localhost/your-project-folder/`

## Usage

### Sign Up
* Users must first sign up by providing a username, email, and password

### Sign In
* After signing up, users can log in with their credentials

### Create a Post
* Once logged in, users can create a post with a title, content, and optional image

### View Posts
* Users can view posts from other users, and each post has a comment section

### Send Friend Requests
* Users can send friend requests to other users
* When the request is accepted, users become friends and can message each other

### Send Messages
* Users can send real-time messages to their friends

## Website
You can access the live version of the application here: [Social App Live Demo](http://social-app.free.nf/)

## Contributing
If you'd like to contribute to this project, please fork the repository and create a pull request with your changes. Ensure that your code follows the existing conventions and is properly tested.

## Acknowledgments
* PHP and MySQL for the backend
* HTML, CSS, and jQuery for the frontend