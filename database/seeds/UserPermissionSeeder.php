<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPermissionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'user_permission_id' => 1,
                'name' => 'users_register',
                'description' => 'Регистрация пользователя',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 2,
                'name' => 'user_permissions_new',
                'description' => 'Создание прав доступа',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 3,
                'name' => 'user_permissions_edit',
                'description' => 'Редактирование прав доступа',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 4,
                'name' => 'user_permissions_delete',
                'description' => 'Удаление прав доступа',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 5,
                'name' => 'user_permissions',
                'description' => 'Список прав доступа',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 6,
                'name' => 'user_groups_new',
                'description' => 'Добавление группы пользователя',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 7,
                'name' => 'user_groups_edit',
                'description' => 'Редактирование группы пользователя',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 8,
                'name' => 'user_groups_delete',
                'description' => 'Удаление группы пользователя',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 9,
                'name' => 'user_groups',
                'description' => 'Список групп пользователя',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 10,
                'name' => 'test_permission',
                'description' => 'Тестовая',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 11,
                'name' => 'users',
                'description' => 'Список пользователей',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 12,
                'name' => 'users_show',
                'description' => 'Просмотр пользователя',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 13,
                'name' => 'users_edit',
                'description' => 'Редатикрование пользователя',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 14,
                'name' => 'users_delete',
                'description' => 'Удаление пользователя',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 15,
                'name' => 'users_change_password',
                'description' => 'Редактирование пароля',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 16,
                'name' => 'test_delete',
                'description' => 'test_delete',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 17,
                'name' => 'customer_groups_new',
                'description' => 'Создание группы клиентов',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 18,
                'name' => 'customer_groups_edit',
                'description' => 'Редактированиеи группы клиентов',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 19,
                'name' => 'customer_groups_delete',
                'description' => 'Удаление группы клиентов',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 20,
                'name' => 'customer_groups',
                'description' => 'Список группы клиентов',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 21,
                'name' => 'customer_groups_show',
                'description' => 'Просмотр группы клиентов',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 22,
                'name' => 'customers_new',
                'description' => 'Создание нового клиента',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 23,
                'name' => 'customers_edit',
                'description' => 'Редактирование клиента',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 24,
                'name' => 'customers',
                'description' => 'Просмотр клиентов',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 25,
                'name' => 'customers_show',
                'description' => 'Просмотр клиента',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 26,
                'name' => 'company_phonelines_new',
                'description' => 'Создание телефонной линии',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 27,
                'name' => 'company_phonelines_edit',
                'description' => 'Редактирование телефонной линии',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 28,
                'name' => 'company_phonelines_delete',
                'description' => 'Удаление телефонной линии',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 29,
                'name' => 'company_phonelines',
                'description' => 'Список телефонных линий',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 30,
                'name' => 'company_phonelines_show',
                'description' => 'Просмотр телефонных линий',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 31,
                'name' => 'user_permissions_show',
                'description' => 'Просмотр права доступа',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 32,
                'name' => 'user_groups_show',
                'description' => 'Просмотр группы пользователя',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 33,
                'name' => 'call_activities_new',
                'description' => 'Создание',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 34,
                'name' => 'call_activities_edit',
                'description' => 'Редактирование',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 35,
                'name' => 'call_activities',
                'description' => 'Просмотр',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 36,
                'name' => 'call_activities_show',
                'description' => 'Просмотр определенной записи',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 37,
                'name' => 'users_avatar',
                'description' => 'Загрузка аватарки',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 38,
                'name' => 'categories_new',
                'description' => 'Создание категории',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 39,
                'name' => 'categories_edit',
                'description' => 'Редактирование категории',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 40,
                'name' => 'categories_delete',
                'description' => 'Удаление категории',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 41,
                'name' => 'categories',
                'description' => 'Получение категорий',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 42,
                'name' => 'categories_show',
                'description' => 'Получение категории',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 43,
                'name' => 'categories_images_upload',
                'description' => 'Загрузка изображения для категории',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 44,
                'name' => 'categories_images_delete',
                'description' => 'Удаление изображения для категории',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 45,
                'name' => 'category_badges_new',
                'description' => 'Создание значка категории',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 46,
                'name' => 'category_badges_edit',
                'description' => 'Редактирование значка категории',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 47,
                'name' => 'category_badges_delete',
                'description' => 'Удаление значка категории',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 48,
                'name' => 'category_badges',
                'description' => 'Получение значков категорий',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 49,
                'name' => 'category_badges_show',
                'description' => 'Получение значка категории',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 50,
                'name' => 'category_badges_images_upload',
                'description' => 'Загрузка изображения для значка категории',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 51,
                'name' => 'category_badges_images_delete',
                'description' => 'Удаление изображения для значка категории',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 52,
                'name' => 'products_new',
                'description' => 'Добавление товара',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 53,
                'name' => 'products_edit',
                'description' => 'Редактирование товара',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 54,
                'name' => 'products_delete',
                'description' => 'Удаление товара',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 55,
                'name' => 'products',
                'description' => 'Получение товаров',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 56,
                'name' => 'products_show',
                'description' => 'Получение товара',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 57,
                'name' => 'companies_new',
                'description' => 'Создание компании',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 58,
                'name' => 'companies_edit',
                'description' => 'Редактирование компании',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 59,
                'name' => 'companies_delete',
                'description' => 'Удаление компании',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 60,
                'name' => 'companies',
                'description' => 'Просмотр компаний',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 61,
                'name' => 'companies_show',
                'description' => 'Просмотр компании',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 62,
                'name' => 'products_images_upload',
                'description' => 'Загрузка изображения',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 63,
                'name' => 'products_images_delete',
                'description' => 'Удаление изображения',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 64,
                'name' => 'menus_new',
                'description' => 'Добавление меню',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 65,
                'name' => 'menus_edit',
                'description' => 'Редактирование меню',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 66,
                'name' => 'menus_delete',
                'description' => 'Удаление меню',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 67,
                'name' => 'menus',
                'description' => 'Просмотр меню',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 68,
                'name' => 'menus_show',
                'description' => 'Просмотр меню',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 69,
                'name' => 'unit_classes_new',
                'description' => 'Добавление ед измерения',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 70,
                'name' => 'unit_classes_edit',
                'description' => 'Редактирование ед измерения',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 71,
                'name' => 'unit_classes_delete',
                'description' => 'Удаление ед измерения',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 72,
                'name' => 'unit_classes',
                'description' => 'Просмотр ед измерения',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 73,
                'name' => 'unit_classes_show',
                'description' => 'Просмотр ед измерения',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 74,
                'name' => 'weight_classes_new',
                'description' => 'Добавление ед веса',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 75,
                'name' => 'weight_classes_edit',
                'description' => 'Редактирование ед веса',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 76,
                'name' => 'weight_classes_delete',
                'description' => 'Удаление ед веса',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 77,
                'name' => 'weight_classes',
                'description' => 'Просмотр ед веса',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 78,
                'name' => 'weight_classes_show',
                'description' => 'Просмотр ед веса',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 79,
                'name' => 'rebind_classes_show',
                'description' => 'Изменения ед веса по умолчанию',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 80,
                'name' => 'currencies_new',
                'description' => 'Добавление валюты',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 81,
                'name' => 'currencies_edit',
                'description' => 'Редактирование валюты',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 82,
                'name' => 'currencies_delete',
                'description' => 'Удаление валюты',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 83,
                'name' => 'currencies',
                'description' => 'Просмотр валют',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 84,
                'name' => 'currencies_show',
                'description' => 'Просмотр валюты',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 85,
                'name' => 'currencies_rebind',
                'description' => 'Изменения валюты по умолчанию',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 86,
                'name' => 'currencies_refresh_exchange_rate',
                'description' => 'Изменения валюты по умолчанию',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 87,
                'name' => 'languages_new',
                'description' => 'Добавление языка',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 88,
                'name' => 'languages_edit',
                'description' => 'Редактирования языка',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 89,
                'name' => 'languages_delete',
                'description' => 'Удаление языка',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 90,
                'name' => 'languages',
                'description' => 'Просмотр языков',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 91,
                'name' => 'languages_show',
                'description' => 'Просмотр языка',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 92,
                'name' => 'languages_images_upload',
                'description' => 'Загрузка изображения',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 93,
                'name' => 'languages_images_delete',
                'description' => 'Удаление изображения',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 94,
                'name' => 'company_settings_by_key',
                'description' => 'Получение настройки по слючу',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 95,
                'name' => 'discount_operations_history',
                'description' => '',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 96,
                'name' => 'discount_released_cards_release_mass',
                'description' => '',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 97,
                'name' => 'discount_cards_send_request_activate',
                'description' => '',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 98,
                'name' => 'discount_cards_activate',
                'description' => '',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 99,
                'name' => 'discount_cards_deactivate',
                'description' => '',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 100,
                'name' => 'discount_cards_get_balance',
                'description' => '',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 101,
                'name' => 'discount_cards_balance_replenishment',
                'description' => '',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 102,
                'name' => 'discount_cards_rebind',
                'description' => '',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 103,
                'name' => 'orders_new',
                'description' => '',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 104,
                'name' => 'orders_edit',
                'description' => '',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 105,
                'name' => 'orders',
                'description' => '',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 106,
                'name' => 'orders_show',
                'description' => '',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 107,
                'name' => 'get_directories',
                'description' => '',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 108,
                'name' => 'product_types',
                'description' => '',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 109,
                'name' => 'products_by_menu',
                'description' => '',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 110,
                'name' => 'companies_show_by_url',
                'description' => '',
                'language_id' => 1
            ],
            [
                'user_permission_id' => 111,
                'name' => 'customer_telephones',
                'description' => '',
                'language_id' => 1
            ],
        ];

        foreach ($data as $item) {
            DB::table('user_permissions')->insert([
                'user_permission_id' => $item['user_permission_id'],
                'name' => $item['name']
            ]);
            DB::table('user_permission_descriptions')->insert([
                'user_permission_id' => $item['user_permission_id'],
                'description' => $item['description'],
                'language_id' => $item['language_id']
            ]);
        }
    }
}
