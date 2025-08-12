# Modulo 3 Finite State Machine API (Laravel)

This project implements a Finite State Machine (FSM) that calculates the remainder modulo 3 for a binary input stream.

The FSM is based on the following formal definition:

## FSM Definition

### States  
\[
Q = \{ S_0, S_1, S_2 \}
\]

### Alphabet  
\[
\Sigma = \{ 0, 1 \}
\]

### Start state  
\[
q_0 = S_0
\]

### Final states  
\[
F = \{ S_0, S_1, S_2 \} \quad \text{(all states are accepting)}
\]

### Transition function \(\delta\):

| Current State | Input 0 | Input 1 |
|---------------|---------|---------|
| S0            | S0      | S1      |
| S1            | S2      | S0      |
| S2            | S1      | S2      |

### State meaning:

- **S0** → remainder 0 (divisible by 3)  
- **S1** → remainder 1  
- **S2** → remainder 2  

---

## API Specification

### Endpoint

```bash
POST /api/modulo3

Request Body
You can send the binary sequence either as a string or an array of bits.

Example (string)
json
Copy
Edit
{
  "bits": "1011"
}
Example (array)
json
Copy
Edit
{
  "bits": [1, 0, 1, 1]
}
Response
json
Copy
Edit
{
  "input": "1011",
  "final_state": "S2",
  "remainder": 2,
  "divisible": false
}
Example Usage
bash
Copy
Edit
curl -X POST http://localhost/api/modulo3 \
  -H "Content-Type: application/json" \
  -d '{"bits":"110"}'
Response:

json
Copy
Edit
{
  "input": "110",
  "final_state": "S0",
  "remainder": 0,
  "divisible": true
}
Development
Installation
Clone the repository:

bash
Copy
Edit
git clone https://github.com/your-username/modulo3-fsm-api.git
cd modulo3-fsm-api
Install dependencies:

bash
Copy
Edit
composer install
Configure environment:

bash
Copy
Edit
cp .env.example .env
php artisan key:generate
Run server:

bash
Copy
Edit
php artisan serve
Testing
This project includes feature tests to verify API correctness.

Run tests:

bash
Copy
Edit
php artisan test --filter=Modulo3ApiTest
Project Structure
app/Services/Modulo3FsmService.php — FSM implementation using δ table.

app/Http/Controllers/Modulo3Controller.php — API controller.

routes/api.php — API route definition.

tests/Feature/Modulo3ApiTest.php — PHPUnit tests.

License
MIT License — free to use, modify, and distribute.

yaml
Copy
Edit

---

If you want, I can save this as a `README.md` file for you right now. Just tell me!s
