# Modulo 3 Finite State Machine API (Laravel)

This project implements a Finite State Machine (FSM) that calculates the remainder modulo 3 for a binary input stream.

The FSM is based on the following formal definition:

## FSM Definition

### States  
Q={S0,S1,S2}

### Alphabet  
Σ={0,1}

### Start state  
S0

### Final states  
F={S0,S1,S2} (all states are accepting)

### Transition function δ:

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
```

### Request Body
You can send the binary sequence either as a string or an array of bits.

### Example JSON (string)
```bash
{
  "bits": "1011"
}
```
### Example (array)
```bash
{
  "bits": [1, 0, 1, 1]
}
```

### Response
```bash
{
  "input": "1011",
  "final_state": "S2",
  "remainder": 2,
  "divisible": false
}
```

### Example Usage
```bash
curl -X POST http://localhost/api/modulo3 \
  -H "Content-Type: application/json" \
  -d '{"bits":"110"}'
  ```

### Response:
```bash
{
  "input": "110",
  "final_state": "S0",
  "remainder": 0,
  "divisible": true
}
```
### State meaning:

- Input bits must be a non-empty string containing only 0 and 1.
- Invalid input will return HTTP status 422 Unprocessable Entity.

### Setup Instructions

1. Clone the repository:

```bash

git clone https://github.com/your-username/modulo3-fsm-api.git
cd modulo3-fsm-api
```

2. Install dependencies

```bash
composer install
```

3. Configure environment:

```bash
cp .env.example .env
php artisan key:generate
```

4. Run server:

```bash
php artisan serve
```

5. Testing

This project includes feature tests to verify API correctness.

Run tests:

```bash

php artisan test --filter=Modulo3ApiTest
```

### Project Structure
app/Services/Modulo3FsmService.php — FSM implementation using δ table.

app/Http/Controllers/Modulo3Controller.php — API controller.

routes/api.php — API route definition.

tests/Feature/Modulo3ApiTest.php — PHPUnit tests.

### License
MIT License — free to use, modify, and distribute.

