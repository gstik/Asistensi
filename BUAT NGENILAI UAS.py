def shamirs_secret_sharing(secret, k, x_values):
    def polynomial(x, k):
        return secret + k * x

    y_values = [polynomial(x, k) for x in x_values]
    shares = list(zip(x_values, y_values))
    return shares, k

def lagrange_interpolation(x_values, y_values, x):
    def basis_polynomial(i):
        result = 1
        for j in range(len(x_values)):
            if i != j:
                result *= (x - x_values[j]) / (x_values[i] - x_values[j])
        return result

    result = 0
    for i in range(len(y_values)):
        result += y_values[i] * basis_polynomial(i)
    return result

def validate_and_transform_key(secret):
    secret_str = str(secret)
    if len(secret_str) == 2:
        return int('3' + secret_str)
    elif len(secret_str) == 3 and secret_str.startswith('3'):
        return secret
    else:
        raise ValueError("Kunci harus terdiri dari 2 atau 3 digit dan diawali dengan angka 3 jika terdiri dari 3 digit")

def construct_and_reconstruct_key():
    while True:
        try:
            # Bagian konstruksi kunci
            secret = int(input("[1] Masukkan kunci (3 + 2 digit NIM): "))
            k = int(input("[2] Masukkan nilai acak (k): "))
            secret = validate_and_transform_key(secret)

            x_values = []
            while len(x_values) < 5:
                x_values_input = input("[3] Masukkan nilai X dipisahkan dengan spasi (minimal 5 nilai): ").split()
                x_values = [int(x) for x in x_values_input]

            print("\n===Detail Proses Konstruksi:")
            print(f"Kunci: {secret}")
            print(f"Nilai acak (k): {k}")
            print(f"Nilai X: {x_values}")

            # Menghitung potongan-potongan rahasia
            y_values = []
            for x in x_values:
                y = secret + k * x
                y_values.append(y)
                print(f"Untuk X = {x}: f({x}) = {secret} + {k} * {x} = {secret} + {k * x} = {y}")

            shares, k_value = list(zip(x_values, y_values)), k

            print("\n===Potongan-potongan rahasia untuk setiap partisipan (X, Y):")
            for x, y in shares:
                print(f"({x}, {y})")

            # Bagian rekonstruksi kunci
            x0_y0 = input("\n\n[4] Masukkan nilai X0 dan Y0 dipisahkan dengan spasi atau koma: ").replace(",", " ").split()
            x1_y1 = input("[5] Masukkan nilai X1 dan Y1 dipisahkan dengan spasi atau koma: ").replace(",", " ").split()

            x0, y0 = int(x0_y0[0]), int(x0_y0[1])
            x1, y1 = int(x1_y1[0]), int(x1_y1[1])

            x_values = [x0, x1]
            y_values = [y0, y1]

            secret_reconstructed = lagrange_interpolation(x_values, y_values, 0)

            # Menggunakan format pecahan atas-bawah untuk hasil Lagrange
            from fractions import Fraction
            L0_fraction = Fraction(0 - x1, x0 - x1)
            L1_fraction = Fraction(0 - x0, x1 - x0)

            L0 = L0_fraction
            L1 = L1_fraction

            print("\n===Detail Proses Perhitungan:")
            print(f"---Langkah 1: Memasukkan nilai X0, Y0, X1, Y1")
            print(f"X0: {x0}, Y0: {y0}")
            print(f"X1: {x1}, Y1: {y1}")

            print("\n---Langkah 2: Menghitung nilai Lagrange basis polynomial")
            print(f"L0: (0 - {x1}) / ({x0} - {x1}) = {L0.numerator}/{L0.denominator}")
            print(f"L1: (0 - {x0}) / ({x1} - {x0}) = {L1.numerator}/{L1.denominator}")

            print("\n---Langkah 3: Menghitung kunci rekonstruksi dengan lebih detail")
            print(f"f(x) = ({y0} * ({L0.numerator}/{L0.denominator}) * (x - {x1})) + ({y1} * ({L1.numerator}/{L1.denominator}) * (x - {x0}))")
            print(f"     = ({y0} * ({L0})) * (x - {x1}) + ({y1} * ({L1})) * (x - {x0})")
            term1 = y0 * L0
            term2 = y1 * L1
            print(f"     = {term1}(x - {x1}) + {term2}(x - {x0})")
            secret_reconstructed = term1 + term2
            print(f"Kunci rekonstruksi = {term1} + ({term2}) = {secret_reconstructed}")

            print(f"\n===Persamaan rekonstruksi kunci: f(x) = {k_value}x + {int(secret_reconstructed)}===")

        except ValueError as e:
            print(f"Input tidak valid. Error: {e}")

        ulang = input("\nApakah Anda ingin mengulang proses (1/Y/y/1 atau 0/N/T/t)? ").strip().lower()
        if ulang not in ['1', 'y']:
            break

if __name__ == "__main__":
    construct_and_reconstruct_key()
