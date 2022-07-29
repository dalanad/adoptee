<div style="text-align:center"><img src="./assets/images/logo.png" /></div>

## "Adoptee" - A Pet adoption and Animal Support Platform

Adoptee is a platform that has the goal to strengthen the 
bond between the general public and 
animal welfare organizations in Sri Lanka.

### Product Feature Summery

- Allows organizations to list animals that are available for adoption.
- Searching and making adoption requests.
- Handling cases about injured/abandoned animals.
- Vaccine reminders and regular updates of the adopted animals.
- Organizational profile / timeline of the organizations.
- Donate or sponsor to the organizations.
- Portal to consult veterinarians remotely.
- Maintain health records of animals consulted
### Development

- Install Docker 
- setup config variables in docker compose or in `/lib/core/Config.php`
- Run `docker compose up`
- Goto  `"localhost/scripts/admin.php"` and click "seed data"

#### User Accounts

- Registered User : user@example.com / 12345678
- Organization User : orguser@example.com / 12345678
- Organization Admin : admin1@example.com / 12345678
- Doctor : doctor@example.com / 12345678

### Documentation

- All docs are available in the `/_docs` folder
- Diagrams & specifications are available in the SRS

### Deployment
- Use the `docker-compose-prod.yml` to deploy full application
- Setup config variables in docker compose or in `/lib/core/Config.php`
- Optional : You can also build `Dockerfile` to get an application image
    - Provide database host as `DB_HOST` environment variable


### Screen Captures
<div style="text-align:center"><img src="./_docs/screenshots/screenshot_1.png" /></div>
<div style="text-align:center"><img src="./_docs/screenshots/screenshot_3.png" /></div>
<div style="text-align:center"><img src="./_docs/screenshots/screenshot_2.png" /></div>
<div style="text-align:center"><img src="./_docs/screenshots/screenshot_4.png" /></div>
