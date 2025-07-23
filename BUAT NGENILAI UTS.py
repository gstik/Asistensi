def vigenere_cipher_encrypt_with_steps(full_plaintext, key, selected_plaintext):
    print("\n### Proses Perhitungan Vigenere Cipher ###")
    full_plaintext = full_plaintext.upper()
    key = key.upper()
    selected_plaintext = selected_plaintext.upper()

    if selected_plaintext not in full_plaintext:
        print("Bagian plaintext yang dipilih tidak ditemukan dalam plaintext penuh.")
        return

    repeated_key = ""
    j = 0
    for i in range(len(full_plaintext)):
        if full_plaintext[i].isalpha():
            repeated_key += key[j]
            j = (j + 1) % len(key)
        else:
            repeated_key += " "

    print(f"Plaintext penuh: {full_plaintext}")
    print(f"Key (berulang): {repeated_key}")
    print("\nPembagian key terhadap plaintext:")
    plaintext_split = [ch for ch in full_plaintext]
    key_split = [ch for ch in repeated_key]
    print(" ".join(plaintext_split))
    print(" ".join(key_split))

    start_idx = full_plaintext.index(selected_plaintext)
    end_idx = start_idx + len(selected_plaintext)
    key_for_selection = repeated_key[start_idx:end_idx]

    print(f"\nBagian plaintext yang dipilih: {selected_plaintext}")
    print(f"Key untuk bagian tersebut:     {key_for_selection}")

    ciphertext = ""
    print("\nLangkah-langkah perhitungan:")
    print(f"{'Idx':<5}{'Plaintext (P)':<15}{'Key (K)':<10}{'P+K':<10}{'Ciphertext (C)':<10}")
    print("-" * 50)

    for i, (p_char, k_char) in enumerate(zip(selected_plaintext, key_for_selection)):
        if not p_char.isalpha():
            ciphertext += p_char
            continue
        p_val = ord(p_char) - 65
        k_val = ord(k_char) - 65
        c_val = (p_val + k_val) % 26
        c_char = chr(c_val + 65)
        ciphertext += c_char
        print(f"{i:<5}{p_char:<15}{k_char:<10}{p_val + k_val:<10}{c_char:<10}")

    return ciphertext


def vigenere_decrypt_pair(cipher_pair, key_pair):
    alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
    plain_pair = ''

    for i in range(2):
        cipher_char = cipher_pair[i]
        key_char = key_pair[i]
        plain_index = (alphabet.index(cipher_char) - alphabet.index(key_char)) % 26
        plain_pair += alphabet[plain_index]
    return plain_pair


def xor_operation(blocks):
    max_length = max(len(block) for block in blocks)
    padded_blocks = [block.ljust(max_length, '0') for block in blocks]
    result = ''.join(str(int(b1) ^ int(b2)) for b1, b2 in zip(*padded_blocks))
    return result[:min(len(block) for block in blocks)]


def format_output(blocks, result):
    formatted_blocks = [' '.join([block[i:i+4] for i in range(0, len(block), 4)]) for block in blocks]
    formatted_result = ' '.join([result[i:i+4] for i in range(0, len(result), 4)])
    blocks_str = ' ⊕ '.join(f'({block})' for block in formatted_blocks)
    print(f"\n{blocks_str} = {formatted_result}")



def main():
    while True:
        print("\n---### MENU PROGRAM  ###---")
        print("1. Program Vigenere Cipher 7 Digit Nama")
        print("2. Program Dekrip Key Relations")
        print("3. Program XOR Only")
        print("4. Keluar")

        choice = input("Pilih program yang ingin dijalankan (1/2/3/4): ").strip()
        print("=====================================")

        if choice == "1":
            full_plaintext = "PRODI INFORMATIKA FTI UAD"
            print("Plaintext penuh:", full_plaintext)
            selected_plaintext = input("Masukkan bagian plaintext yang ingin dienkripsi: ").strip()
            key = input("Masukkan key (7 huruf): ").strip()[:7]
            if not key.isalpha():
                print("Key harus hanya terdiri dari huruf.")
                continue
            ciphertext = vigenere_cipher_encrypt_with_steps(full_plaintext, key, selected_plaintext)
            print("\nHasil Ciphertext:", ciphertext)

        elif choice == "2":
            ciphertext = "LKSMEMPOGAJXSEKSMEHZ".replace(" ", "")
            key = "RELATIONS"
            cipher_pairs = [
                "LK", "KS", "SM", "ME", "EM",
                "MP", "PO", "OG", "GA", "AJ"
            ]
            for n in range(1, 11):
                cipher_pair = cipher_pairs[n - 1]
                key_pair = key[(n - 1) % len(key)] + key[n % len(key)]
                decrypted_pair = vigenere_decrypt_pair(cipher_pair, key_pair)
                temp = [cipher_pair[0], cipher_pair[1]]
                temp2 = [key_pair[0], key_pair[1]]
                temp3 = [decrypted_pair[0], decrypted_pair[1]]
                print(f"n = {n}")
                for i in range(2):
                    print(f"Cipher: {temp[i]}")
                    print(f"Key: {temp2[i]}")
                    print(f"Plain: ({temp[i]} - {temp2[i]}) mod 26")
                    print(f"Plain: ({ord(temp[i]) - 65} - {ord(temp2[i]) - 65}) mod 26")
                    print(f"Plain: {ord(temp[i]) - ord(temp2[i])} mod 26")
                    print(f"Plain: {(ord(temp[i]) - ord(temp2[i])) % 26}")
                    print(f"Plain: {temp3[i]}")
                    print()
                print("=====================================")

        elif choice == "3":
            block1 = input("Masukkan blok biner pertama: ").replace(" ", "")
            block2 = input("Masukkan blok biner kedua: ").replace(" ", "")
            blocks = [block1, block2]
            result = xor_operation(blocks)
            format_output(blocks, result)

        elif choice == "4":
            print("Keluar dari program.")
            break
        else:
            print("Pilihan tidak valid. Silakan pilih antara 1, 2, 3, atau 4.")


if __name__ == "__main__":
    main()
