# Local development environment

> **Compatibility rule:** version 3.2.11 is maintenance-only. Changes on this
> line are limited to immediate bug and security fixes, and must be verified by
> upgrading an existing 3.2.11 installation in place. Testing only a clean
> installation is not sufficient.

This Compose stack is intended for local migration and regression testing only.
It binds the web interface to the loopback address and does not publish MariaDB.

## Start the application

```sh
cp .env.example .env
docker compose up -d app
docker compose ps
```

Open <http://127.0.0.1:8080>. The first run creates the legacy sysPass 3.2.11
baseline. Use these database settings in the installer:

- Server: `db`
- Database user: `syspass`
- Password: the value of `SYSPASS_DB_PASSWORD` in `.env`
- Database: `syspass`
- Hosting Mode: enabled

For a disposable local baseline, the following application credentials are
recommended:

- sysPass administrator: `admin`
- Administrator password: `syspass_admin`
- Master password: `00123456789`

After the installer finishes, the named `legacy-*` volumes represent an
existing sysPass 3.2.11 installation. Keep these volumes intact while testing
the application and database upgrade path.

The application source is mounted from the checkout. Configuration, backups,
cache, temporary files, dependencies, and database data live in Docker volumes.
Compose initializes the application volumes with the permissions required by
Apache before starting the web container.

## Run the test suite

```sh
docker compose --profile test run --rm test
```

The test profile uses separate `test-db` and `test-vendor` volumes. It runs the
Core suite used by the upstream 3.2 release pipeline and cannot alter the
preserved `legacy-db` baseline.

## Inspect and stop

```sh
docker compose logs -f app db
docker compose down
```

`docker compose down` preserves data. To remove this local environment's Docker
volumes as well, use `docker compose down --volumes` only after confirming that
the local test data is no longer needed.
