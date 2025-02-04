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
```

## 💾 Struktura databáze

### 📌 Tabulky a jejich sloupce

**🟢 users**  
- `id` – Primární klíč  
- `nickname` – Přezdívka uživatele  
- `email` – Emailová adresa  
- `password` – Hashované heslo  

**🟢 admins**  
- `id` – Primární klíč  
- `admin_name` – Jméno administrátora  
- `password` – Hashované heslo  

**🟢 dictionaries**  
- `id` – Primární klíč  
- `user_id` – Cizí klíč odkazující na `users(id)`  
- `dictionary_name` – Název slovníku  

**🟢 words**  
- `id` – Primární klíč  
- `dictionary_id` – Cizí klíč odkazující na `dictionaries(id)`  
- `word` – Slovíčko  
- `translation` – Překlad  

---

## 🌍 Použité technologie

- **Backend:** PHP  
- **Databáze:** MySQL  
- **Frontend:** HTML, CSS, JavaScript  
- **Hosting (volitelně):** Laragon / XAMPP pro lokální vývoj  

---
