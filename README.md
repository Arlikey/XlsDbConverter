# XlsDbConverter

A simple website to import records from `.xlsx` or `.xls` Excel files into your database and export records from the database back into Excel format.

## 📘 About the Project

This project was created for educational purposes and does not offer full production-ready functionality for importing/exporting arbitrary Excel tables to/from a database.

## 📦 Used Libraries

This project relies on the following libraries:

1. [**illuminate/database**](https://github.com/illuminate/database) — A full-featured database toolkit for PHP, providing an expressive query builder, ActiveRecord-style ORM, and schema builder. It is also the database layer used in the Laravel framework.
2. [**PHPOffice/PhpSpreadsheet**](https://github.com/PHPOffice/PhpSpreadsheet) — A pure PHP library for reading and writing spreadsheet files, including support for Excel and LibreOffice Calc formats.

## 🚀 Usage

> ⚠️ **Note:** This implementation does not follow the Dependency Inversion Principle and is tightly coupled to a specific table structure. It's not reusable for arbitrary database tables out of the box. However, feel free to modify or extend it to suit your needs!
