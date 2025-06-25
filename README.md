# 🛠️ Web-Based Support Ticket System

A responsive web-based support ticket submission platform that allows users to submit detailed support requests. The system supports file uploads and stores submitted data securely in a PostgreSQL database.

---

## 📌 Features

- 📄 Submit detailed support tickets via a clean web form  
- 📎 Upload proof files (images, PDFs, documents)  
- 🛡️ Secure data handling via PHP backend  
- 🗃️ PostgreSQL database integration for storing ticket data  
- 💬 Instant feedback for successful or failed submissions  
- 📱 Fully responsive layout with smooth animations  
- 🎨 Styled with custom CSS for a clean and modern UI  

---

## 🧰 Technologies Used

- HTML5 & CSS3  
- PHP (Backend processing)  
- PostgreSQL (Database)  
- JavaScript (Form enhancements)  

---

## 🚀 Getting Started

### 1. Clone the repository

```bash
git clone https://github.com/yourusername/support-ticket-system.git
cd support-ticket-system

2. Set up PostgreSQL
	•	Create a database named support_system
	•	Create a table called support_tickets with relevant columns:

CREATE TABLE support_tickets (
  id SERIAL PRIMARY KEY,
  name TEXT NOT NULL,
  email TEXT NOT NULL,
  issue TEXT NOT NULL,
  file_path TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

3. Configure Database Connection

In your submit_ticket.php, update the PostgreSQL connection credentials:

$host = "localhost";
$dbname = "support_system";
$user = "your_pg_user";
$password = "your_pg_password";

4. Run the Application
	•	Open index.html in a browser.
	•	Submit a ticket and monitor the uploads and database entries.
	•	You should see a success or error message based on form processing.

⸻

📁 Project Structure

.
├── index.html              # Main form UI (to be added)
├── style.css               # Styling for the form
├── submit_ticket.php       # Backend logic for processing form submissions
├── uploads/                # Directory where uploaded files are stored
└── README.md               # This file


⸻

🛡️ Security Notes
	•	Input validation and file type restrictions should be strengthened for production use.
	•	Sanitize file uploads and user input to prevent SQL injection and XSS attacks.
	•	Secure the uploads/ directory to prevent unauthorized access.


⸻

📄 License

This project is open-source and available under the MIT License.

⸻

🙋‍♂️ Author

Joel R Tharakan
GitHub: @Joelrtharakan
Email: joelrtharakan.in@gmail.com

⸻

