# Repository rules

## Upgrade compatibility

- Treat version 3.2.11 as a maintenance-only baseline.
- Only immediate bug fixes and security fixes may be added to the 3.2.11 line.
- Every change must support an in-place upgrade from an existing 3.2.11
  installation. A clean installation is not sufficient evidence of compatibility.
- Preserve existing configuration files, encrypted secrets, database contents,
  user accounts, plugins, backups, and public/API behavior unless a documented
  security fix strictly requires a change.
- Database or configuration changes must include an idempotent, versioned
  migration and a tested upgrade path from the preceding stored version.
- Do not require users to delete volumes, recreate the database, reinstall the
  application, or manually re-enter secrets as part of an upgrade.
- Before accepting a fix, test it against a copy of the installed legacy
  baseline and verify login, secret decryption, and representative read/write
  operations after the upgrade.
- Larger dependency, runtime, schema, architecture, or feature changes belong
  on a separate future-version branch and require an explicit migration path.
