# 📚 Dictionary Learning

**Dictionary Learning** je webová aplikace pro efektivní učení cizích slovíček pomocí kartiček. Uživatelé si mohou vytvářet vlastní slovníky, testovat své znalosti a sledovat svůj pokrok.

## 🚀 Funkce
- ✅ **Vytváření a správa slovníků** – Každý uživatel si může vytvořit vlastní seznam slovíček.
- ✅ **Interaktivní kartičky** – Učení probíhá pomocí systému kartiček, které se zobrazují náhodně.
- ✅ **Testovací režim** – Možnost ověření znalostí pomocí jednoduchých kvízů.
- ✅ **Přehledný uživatelský panel** – Snadná navigace a správa účtu.
- ✅ **Admin rozhraní** – Správa uživatelů a obsahu aplikace.

---

## 🛠️ Instalace

```bash
# Naklonuj repozitář:
git clone https://github.com/tvuj-repo/dictionary-learning.git

# Přesuň se do složky projektu:
cd dictionary-learning

# Nastav databázi: 
# - Vytvoř MySQL databázi
# - Importuj soubor `database.sql`

# Spusť aplikaci na lokálním serveru (např. Laragon, XAMPP).
# Přihlas se nebo vytvoř nový účet.

## 💾 Struktura databáze

### 🗃️ Tabulky a jejich sloupce

| Tabulka       | Sloupce                                       |
|--------------|----------------------------------------------|
| `users`      | `id`, `nickname`, `email`, `password`       |
| `admins`     | `id`, `admin_name`, `password`              |
| `dictionaries` | `id`, `user_id`, `dictionary_name`        |
| `words`      | `id`, `dictionary_id`, `word`, `translation` |

---

## 🌍 Použité technologie

| Technologie  | Použití           |
|-------------|------------------|
| **PHP**     | Backend          |
| **MySQL**   | Databáze         |
| **HTML**    | Struktura webu   |
| **CSS**     | Stylování        |
| **JavaScript** | Interaktivita  |
