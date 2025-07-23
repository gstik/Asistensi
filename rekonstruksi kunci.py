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

def reconstruct_key():
    # Memasukkan nilai dari user
    x0 = int(input("Masukkan nilai X0: "))
    y0 = int(input("Masukkan nilai Y0: "))
    x1 = int(input("Masukkan nilai X1: "))
    y1 = int(input("Masukkan nilai Y1: "))

    # Pasangan (X, Y)
    x_values = [x0, x1]
    y_values = [y0, y1]

    # Rekonstruksi kunci menggunakan Lagrange Interpolation
    secret = lagrange_interpolation(x_values, y_values, 0)

    # Perhitungan koefisien Lagrange untuk X0 dan X1
    L0 = (0 - x1) / (x0 - x1)
    L1 = (0 - x0) / (x1 - x0)

    # Menampilkan hasil perhitungan mendetail
    print("\nDetail Proses Perhitungan:")
    print(f"Langkah 1: Memasukkan nilai X0, Y0, X1, Y1")
    print(f"X0: {x0}, Y0: {y0}")
    print(f"X1: {x1}, Y1: {y1}")

    print("\nLangkah 2: Menghitung nilai Lagrange basis polynomial")
    print(f"L0: (0 - {x1}) / (1 - {x1}) = {int(L0)}")
    print(f"L1: (0 - {x0}) / ({x1} - 1) = {int(L1)}")

    print("\nLangkah 3: Menghitung kunci rekonstruksi")
    print(f"Y0 * L0 = {y0} * {int(L0)} = {int(y0 * L0)}")
    print(f"Y1 * L1 = {y1} * {int(L1)} = {int(y1 * L1)}")
    print(f"Kunci rekonstruksi = {int(y0 * L0)} + ({int(y1 * L1)}) = {int(secret)}")

    print(f"\n === Persamaan rekonstruksi kunci: 97x + {int(secret)} ===")

if __name__ == "__main__":
    reconstruct_key()
