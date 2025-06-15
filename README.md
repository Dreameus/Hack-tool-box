# HackToolBox - Ethical Hacking Web Application

HackToolBox is a web interface for popular ethical hacking tools including SQLMap, Nmap, and Sublist3r.

## Features

- SQLMap interface (SQL injection testing)
- Port scanner based on Nmap
- Subdomain scanner based on Sublist3r
- Authentication system (login/logout)
- Operation logging
- Export logs as ZIP archive

## Requirements

- PHP 7.4+
- Python 3.6+
- Installed tools:
  - SQLMap (`git clone https://github.com/sqlmapproject/sqlmap.git`)
  - Nmap (`sudo apt install nmap`)
  - Sublist3r (`pip install sublist3r`)
  - Python nmap library (`pip install python-nmap`)
- Web server (Apache/Nginx)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/your-username/HackToolBox.git
cd HackToolBox
```

2. Install dependencies:
```bash
# Install SQLMap
git clone https://github.com/sqlmapproject/sqlmap.git sqlmap

# Install Sublist3r
pip install sublist3r

# Install Nmap
sudo apt install nmap  # Debian/Ubuntu
sudo yum install nmap  # CentOS/RHEL

# Install Python nmap library
pip install python-nmap
```

3. Set permissions:
```bash
mkdir logs
chmod -R 775 logs
chmod +x scripts/*
```

4. Configure your web server to point to the project directory

5. Access the application in your browser:
```
http://localhost/HackToolBox/login.php
```

6. Default credentials:
- Username: `admin`
- Password: `admin123`

## Usage

1. Login with your credentials
2. Use the navigation tabs to select a tool:
   - **SQLMap**: Test for SQL injection vulnerabilities
   - **Port Scanner**: Scan for open ports on a target
   - **Subdomain Scanner**: Discover subdomains of a domain
   - **Export Logs**: Download all operation logs

3. Enter target information and run scans
4. View results directly in the browser or download logs

## Project Structure

```
HackToolBox/
├── index.php             # Main application interface
├── login.php             # Login page
├── logout.php            # Logout handler
├── run_sqlmap.php        # SQLMap executor
├── run_ports.php         # Port scanner handler
├── run_subdomains.php    # Subdomain scanner handler
├── export_logs.php       # Log export utility
├── scripts/              # Python scripts
│   ├── port_scanner.py   # Nmap-based port scanner
│   └── subdomain_scanner.py
├── logs/                 # Scan logs storage
├── sqlmap/               # SQLMap installation
└── assets/               # CSS/JS resources
```

## Security Notes

1. Always obtain proper authorization before scanning any systems
2. Change default credentials after installation
3. Keep all tools updated regularly
4. Restrict access to the application through firewall rules
5. Use HTTPS in production environments

## Troubleshooting

**Port scanner not working:**
- Ensure nmap is installed (`nmap --version`)
- Verify python-nmap is installed (`pip show python-nmap`)
- Check firewall permissions

**SQLMap errors:**
- Update SQLMap: `cd sqlmap && git pull`
- Verify Python version: `python --version`

**Permission issues:**
- Ensure web server has execute permissions for scripts:
  ```bash
  chown -R www-data:www-data /path/to/HackToolBox
  chmod -R 775 scripts/ logs/
  ```

## License

This project is licensed under the MIT License. Use these tools responsibly and only on systems you have permission to test.
```
To use the port scanner:
1. Install required dependencies:
```bash
pip install python-nmap
```

2. Make the script executable:
```bash
chmod +x scripts/port_scanner.py
```

3. Test directly from command line:
```bash
python scripts/port_scanner.py scanme.nmap.org
python scripts/port_scanner.py example.com 80,443
python scripts/port_scanner.py 192.168.1.1 1-1000
```

The application provides a unified interface for ethical hacking tools while maintaining proper security controls and audit logging.
