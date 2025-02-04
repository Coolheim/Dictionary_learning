# 📚 Dictionary Learning

**URL:** https://app.opent2.com/it3a/kulheimm/Projekt%201/ 

**Dictionary Learning** je webová aplikace pro efektivní učení cizích slovíček pomocí kartiček. Uživatelé si mohou vytvářet vlastní slovníky a testovat své znalosti.

## 🚀 Funkce
- ✅ **Vytváření vlastních slovníků** – Každý uživatel si může vytvořit vlastní seznamy slovíček.
- ✅ **Interaktivní kartičky** – Učení probíhá pomocí systému kartiček.
---

## 🛠️ Instalace


### Naklonuj repozitář:
```bash
git clone https://github.com/tvuj-repo/dictionary-learning.git
```
### Přesuň se do složky projektu:
```bash
cd dictionary-learning
```

## Nastav databázi: 
- Vytvoř MySQL databázi
- Importuj soubor `database.sql`
- Spusť aplikaci na lokálním serveru (např. Laragon, XAMPP).
- Přihlas se nebo vytvoř nový účet.

## 💾 Struktura databáze

### 🟢 users
```bash
CREATE TABLE `users` (
  `id` int NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
)

```
### 🟢 dictionaries
```bash
CREATE TABLE `dictionaries` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `dictionary_data` json NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dictionary_name` varchar(255) NOT NULL
)
```
### 🟢 admins
```bash
CREATE TABLE `admins` (
  `id` int NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
)
```

## 🌍 Použité technologie

- **Backend:** PHP  
- **Databáze:** MySQL  
- **Frontend:** HTML, CSS, JavaScript  
- **Hosting:** Laragon / XAMPP pro lokální vývoj  

---
