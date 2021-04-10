![Prequel](assets/prequel_v1.png)

## Contribution guidelines

#### If these guidelines are not respected there's a high chance your pull request will not be merged

- When contributing to this repository, please first discuss the change you wish to make via an issue!
- Create a branch with a **descriptive name**, e.g. `feature-mysql-support` or `fix-custom-path-not-working`.
- See [Pull Request Template](./pull_request_template.md) to see what your pull request should look like.
- Use concise commit messages, e.g. `[FIX] Fixed x not doing b`.
- Use the [PSR-2 Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md).
- When you have made changes to the front-end, run `$ npm run prod` once before creating a pull request.
- Write tests for new features. No tests means no merge.

## Setup - this will be improved soon.

1. Create or use an existing Laravel project, as long as it has a valid database connection.
2. Forking Prequel
   - Run `composer require protoqol/prequel` and use `vendors/protoqol/prequel` as your workspace.
   - Run `git clone git@github.com:Protoqol/Prequel.git packages/prequel/` and add `"Protoqol\\Prequel\\": "packages/prequel/src/"` to
     your composer.json so it looks like this
   ```json
   "autoload": {
     "psr-4": {
       "App\\": "app/",
       "Protoqol\\Prequel\\": "packages/prequel/src/"
     },
   }
   ```
3. In your Laravel test project run `php artisan vendor:publish --tag=config --provider=Protoqol\Prequel\PrequelServiceProvider` to publish the assets.
4. Navigate to Prequel's root folder.
5. Create a new branch with a descriptive name, no master branch!
6. When making changes to the front-end (.vue files), run `$ npm run watch` to create a hot-reloading server where you can see your changes live.
7. When done with your feature/fix and you have made changes to any .vue file, run `$ npm run prod` to create a final build.
8. You're ready to create a pull request! See [Pull Request Template](./pull_request_template.md) for information.
