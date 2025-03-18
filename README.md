# Voting Management System - A Dynamic Voting System Website
## Overview 📌
The Voting Management System is designed to simplify and streamline the election process. It allows administrators to manage candidates, voting positions, and monitor election results efficiently. Admin features include tracking total votes, voters, candidates, and positions, along with managing candidates and positions through CRUD operations. The platform also provides voters with an easy registration process and a voting page where they can select candidates for various positions. Built with PHP for the backend, MySQL for database management, and a responsive frontend using HTML, CSS, and Tailwind, this system ensures an organized and transparent election experience

![Logo](Overview.png)

## Features 📌
 - Admin
    - Dashboard
        - total Positions: The total number of available positions that voters can choose candidates for
        - total Votes: The overall number of votes cast in the system
        - total Voters: The total number of registered voters who are eligible to vote
        - total Candidates: The total number of candidates running for various positions
        - Latest Voters: A list of the most recent voters, with an "eye" button to view the candidates they selected
        - List of Candidates: Sorted by votes, showing candidates from highest to lowest vote count.
    - Candidates
        - Create, read, update, and delete (CRUD) candidate listings
    - Positions
        - Create, read, update, and delete (CRUD) positions listings
 - Login/Logout
 - End User
    - Register: Voter registration page to allow users to register as eligible voters.
    - Voting Page: Registered voters can select their candidates for each available position.
 ## Tech Stack 📌
 - Frontend: HTML, CSS, Tailwind
 - Backend: PHP
 - Database: MySQL