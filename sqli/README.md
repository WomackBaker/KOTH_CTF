# King of the Hill SQL Injection Challenge

Welcome to **Strickland Propane**, the finest propane and propane accessories company in Arlen, Texas! 

## Challenge Description

You've been hired as a security consultant for Strickland Propane to test their employee portal. The company's IT department has assured Mr. Hill that their system is "propane-grade secure," but you suspect there might be some vulnerabilities in their login system.

Your mission is to access the employee database and find the secret flag that contains valuable company information.

## Setup Instructions

1. **Build the Docker container:**
   ```bash
   docker build -t strickland-propane .
   ```

2. **Run the container:**
   ```bash
   docker run -p 8080:80 strickland-propane
   ```

3. **Access the challenge:**
   - Open your browser and navigate to `http://localhost:8080`
   - You'll see the Strickland Propane employee login portal

## Challenge Details

- **Target:** Strickland Propane Employee Portal
- **Vulnerability:** SQL Injection in login form
- **Database:** SQLite
- **Goal:** Extract the flag from the database

## Available Characters

The database contains employee records for various King of the Hill characters:

- **Hank Hill** - Manager, propane enthusiast
- **Dale Gribble** - Conspiracy theorist
- **Bill Dauterive** - Army veteran
- **Jeff Boomhauer** - Fast-talking neighbor
- **Bobby Hill** - Hank's son
- **Peggy Hill** - Substitute teacher
- **Luanne Platter** - Beauty school student
- **Cotton Hill** - Hank's father
- **Kahn Souphanousinphone** - Laotian neighbor
- **Admin** - System administrator (contains the flag)

## Hints

1. **"Dang it, Bobby!"** - The error message gives you a clue about the database structure
2. **"Taste the meat, not the heat!"** - Sometimes you need to bypass authentication entirely
3. **"I sell propane and propane accessories."** - The flag is related to propane accessories
4. **Character names** - Try using character names as usernames
5. **SQL Injection basics** - Remember common SQL injection techniques like `' OR 1=1 --`

## Learning Objectives

- Understanding SQL injection vulnerabilities
- Learning to identify and exploit authentication bypasses
- Practicing database enumeration techniques
- Understanding the importance of input validation and parameterized queries

## Flag Format

The flag follows the format: `FLAG{propane_accessories_are_the_best}`

## Safety Note

This challenge is designed for educational purposes in a controlled CTF environment. Always practice responsible disclosure and never attempt to exploit vulnerabilities on systems you don't own or have explicit permission to test.

---

*"That's my purse! I don't know you!" - Bobby Hill*

*"I sell propane and propane accessories." - Hank Hill*

*"Pocket sand!" - Dale Gribble* 