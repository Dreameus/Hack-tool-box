#!/usr/bin/env python3
import nmap
import sys

def port_scan(host, ports='1-1000'):
    """
    Perform a port scan using Nmap
    
    Args:
        host (str): Target host (IP or domain)
        ports (str): Port range (default: 1-1000)
    
    Returns:
        str: Scan results in text format
    """
    scanner = nmap.PortScanner()
    arguments = f'-p {ports}'
    
    try:
        print(f"Scanning {host} on ports {ports}...")
        scanner.scan(host, arguments=arguments)
        return format_results(scanner)
    except nmap.PortScannerError as e:
        return f"Error: {str(e)}"
    except Exception as e:
        return f"Unexpected error: {str(e)}"

def format_results(scanner):
    """Format Nmap scan results into readable text"""
    output = []
    for host in scanner.all_hosts():
        output.append(f"Scan results for {host}:")
        output.append(f"Status: {scanner[host].state()}")
        
        for proto in scanner[host].all_protocols():
            output.append(f"\nProtocol: {proto}")
            
            ports = scanner[host][proto].keys()
            for port in sorted(ports):
                port_info = scanner[host][proto][port]
                output.append(
                    f"Port: {port}\tState: {port_info['state']}\tService: {port_info['name']}"
                )
    
    return "\n".join(output)

if __name__ == "__main__":
    if len(sys.argv) < 2:
        print("Usage: python port_scanner.py <host> [ports]")
        print("Example: python port_scanner.py example.com 1-1000")
        sys.exit(1)
    
    host = sys.argv[1]
    ports = sys.argv[2] if len(sys.argv) > 2 else '1-1000'
    
    results = port_scan(host, ports)
    print(results)
