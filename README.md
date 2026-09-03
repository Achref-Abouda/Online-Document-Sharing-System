# Online Document Sharing System

A web-based document management and sharing platform built with PHP and MySQL. It provides an admin dashboard where users can be managed and documents can be uploaded, organized, shared, and downloaded.

## Author

**Achref Abouda**

Cybersecurity Engineer | Network Security

## About the Project

This system is designed for organizations that need a simple internal platform to upload, store, and share documents between staff members. It has two types of accounts — **Administrators** and **Users** — each with a different level of access to the system.

The interface is built on top of the AdminLTE admin dashboard template, using jQuery and AJAX so that most actions (saving, deleting, uploading) happen without reloading the page.

## Features

### Authentication
- Session-based login and logout system.
- Passwords are stored as hashes in the database.
- Users are redirected to the login page if not authenticated.

### User Management (Admin)
- Add, edit, view, and delete user accounts.
- Assign user roles: **Admin** or **User**.
- Upload and change a profile avatar image for each account.
- Duplicate email address checking when creating or editing a user.
- Account self-management ("Manage Account") available from the sidebar for the logged-in user, allowing them to update their own name, email, password, and avatar.

### Document Management
- Upload new documents with a title and an optional rich-text description (via a WYSIWYG editor).
- Attach multiple files to a single document entry using a drag-and-drop uploader with progress bars.
- Supported file types include documents, spreadsheets, presentations, images, audio, video, and archive files.
- Edit existing documents, including replacing or removing attached files.
- Delete documents, which also removes their associated uploaded files from storage.
- Download attached files individually, with the original file name preserved.

### Document Sharing & Access Control
- When creating a document, the uploader can choose to share it with specific users or make it **public** to all users.
- Administrators can see every document in the system.
- Regular users only see documents they uploaded, documents shared with them, or documents marked public.
- A shareable link can be generated for a document via a share modal.

### Listings & Dashboard
- Sortable, searchable data tables for both the user list and the document list.
- Document list shows the title, description preview, and the uploader's name.
- Toast notifications and confirmation dialogs for actions like delete and save.

## Project Structure (Key Files)

| File | Purpose |
|---|---|
| `login.php` | Login screen |
| `header.php` / `footer.php` / `topbar.php` / `sidebar.php` | Shared page layout components |
| `admin_class.php` | Core backend logic (login, user CRUD, document CRUD, file upload/delete) |
| `ajax.php` | Routes AJAX requests to the appropriate backend action |
| `user_list.php` / `new_user.php` / `edit_user.php` / `view_user.php` / `manage_user.php` | User management screens |
| `document_list.php` / `new_document.php` / `new_document2.php` / `edit_document.php` / `view_document.php` | Document management screens |
| `download.php` | Handles file downloads |
| `modal_share_link.php` | Generates a shareable document link |
| `get_users.php` | Returns the list of users as JSON |

## Requirements

See `REQUIREMENTS.md` for the full list of software and setup requirements.

## Getting Started

1. Install a local server environment that provides PHP and MySQL (such as XAMPP).
2. Place the project folder inside the server's web root directory (for XAMPP, the `htdocs` folder).
3. Create a MySQL database and import the project's database structure.
4. Update the database connection settings to match your local database credentials.
5. Start the Apache and MySQL services.
6. Open the project in a web browser through the local server address and log in with an administrator account.

## Notes

- Uploaded files and avatars are stored on the server's file system under the assets/uploads directory.
- This project is intended for internal/local use and should be reviewed and hardened before being exposed on a public server.
- The production deployment is connected to an FTP server that is only accessible through VPN. A VPN connection is required before the FTP server can be reached for deployment or file transfer.

## Copyright & License

Copyright © 2024 Achref Abdoua. All rights reserved.

This project and its source code are the property of Achref Abdoua. Unauthorized copying, distribution, modification, or use of this software, in whole or in part, without express written permission from the author is prohibited.