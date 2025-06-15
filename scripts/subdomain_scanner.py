#!/usr/bin/env python3
import sys
import subprocess

def run_sublist3r(domain):
    try:
        result = subprocess.check_output(['sublist3r', '-d', domain, '-o', '/dev/stdout'], stderr=subprocess.STDOUT)
        return result.decode('utf-8')
    except subprocess.CalledProcessError as e:
        return f"Ошибка: {e.output.decode('utf-8')}"

if __name__ == "__main__":
    if len(sys.argv) != 2:
        print("Использование: python subdomain_scanner.py <domain>")
        sys.exit(1)
    
    domain = sys.argv[1]
    print(f"Сканирование поддоменов для: {domain}\n")
    print(run_sublist3r(domain))
