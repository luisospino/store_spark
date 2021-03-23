<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------

	public $unidades = [
		'nombre' => 'required|alpha|min_length[3]|max_length[10]|is_unique[unidades.nombre,id,{id}]',
		'nombre_corto' => 'required|alpha|min_length[2]|max_length[5]|is_unique[unidades.nombre_corto,id,{id}]',
	];

	public $productos = [
		'codigo' => 'required|is_natural|exact_length[10]|is_unique[productos.codigo,id,{id}]',
		'nombre' => 'required|alpha_numeric_space|min_length[3]|max_length[40]|is_unique[productos.nombre,id,{id}]',
		'id_unidad' => 'required|is_natural_no_zero',
		'id_categoria' => 'required|is_natural_no_zero',
		'precio_venta' => 'required|regex_match[^\d{1,10}(\.\d{1,2})?$]',
		'precio_compra' => 'required|regex_match[^\d{1,10}(\.\d{1,2})?$]',
		'stock_minimo' => 'required|is_natural_no_zero',
		'inventariable' => 'required|is_natural'
	];

	public $categorias = [
		'nombre' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[categorias.nombre,id,{id}]'
	];

	public $clientes = [
		'nombre' => 'required|alpha_space|min_length[3]|max_length[40]',
		'direccion' => 'permit_empty|alpha_numeric_punct|min_length[3]|max_length[40]',
		'telefono' => 'permit_empty|is_natural|exact_length[10]|is_unique[clientes.telefono,id,{id}]',
		'correo' => 'required|valid_email|is_unique[clientes.correo,id,{id}]',
	];

	public $configuracion = [
		'nombre' => 'required|alpha_numeric_space|min_length[3]|max_length[40]',
		'rfc' => 'required|alpha_numeric|exact_length[10]',
		'direccion' => 'required|alpha_numeric_punct|min_length[3]|max_length[40]',
		'telefono' => 'required|is_natural|exact_length[10]',
		'correo' => 'required|valid_email',
		'logo' => 'uploaded[logo]|max_size[logo,1024]|ext_in[logo,png]|mime_in[logo,image/png]'
	];

	public $usuarios = [
		'nombre' => 'required|alpha_space|min_length[3]|max_length[40]',
		'usuario' => 'required|alpha_numeric_space|min_length[3]|max_length[40]|is_unique[usuarios.usuario,id,{id}]',
		'id_rol' => 'required|is_natural_no_zero',
		'id_caja' => 'required|is_natural_no_zero',
		'clave' => 'required|min_length[5]|max_length[40]',
		'clave_confirmacion' => 'required|matches[clave]|min_length[5]|max_length[40]'
	];

	public $usuarios_editar = [
		'nombre' => 'required|alpha_space|min_length[3]|max_length[40]',
		'usuario' => 'required|alpha_numeric_space|min_length[3]|max_length[40]|is_unique[usuarios.usuario,id,{id}]',
		'id_rol' => 'required|is_natural_no_zero',
		'id_caja' => 'required|is_natural_no_zero'
	];

	public $roles = [
		'nombre' => 'required|alpha|min_length[3]|max_length[30]|is_unique[roles.nombre,id,{id}]'
	];

	public $cajas = [
		'numero' => 'required|is_natural|exact_length[3]|is_unique[cajas.numero,id,{id}]',
		'nombre' => 'required|alpha_numeric_space|min_length[3]|max_length[10]|is_unique[cajas.nombre,id,{id}]',
		'folio' => 'required|is_natural|exact_length[3]|is_unique[cajas.folio,id,{id}]'
	];

	public $login = [
		'usuario' => 'required|alpha_numeric_space|min_length[3]|max_length[40]',
		'clave' => 'required'
	];

	public $contrasenha = [
		'clave_actual' => 'required',
		'clave_nueva' => 'required|min_length[5]|max_length[40]',
		'clave_confirmacion' => 'required|matches[clave_nueva]|min_length[5]|max_length[40]'
	];

	public $metodos_pagos = [
		'nombre' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[metodo_pago.nombre,id,{id}]'
	];

	//--------------------------------------------------------------------
	// Error messages
	//--------------------------------------------------------------------

	public $unidades_errors = [
		'nombre' => [
			'required' => 'El campo \'Nombre\' es obligatorio.',
			'alpha' => 'El campo \'Nombre\' solo puede contener caracteres alfabéticos.',
			'min_length' => 'El campo \'Nombre\' debe tener al menos 3 caracteres de longitud.',
			'max_length' => 'El campo \'Nombre\' no puede exceder los 10 caracteres de longitud.',
			'is_unique' => 'El Nombre \'{value}\' ya está en uso.'
		],
		'nombre_corto' => [
			'required' => 'El campo \'Nombre corto\' es obligatorio.',
			'alpha' => 'El campo \'Nombre\' solo puede contener caracteres alfabéticos.',
			'min_length' => 'El campo \'Nombre\' debe tener al menos 3 caracteres de longitud.',
			'max_length' => 'El campo \'Nombre\' no puede exceder los 10 caracteres de longitud.',
			'is_unique' => 'El Nombre corto \'{value}\' ya está en uso.'
		]
	];

	public $productos_errors = [
		'codigo' => [
			'required' => 'El campo \'Codigo\' es obligatorio.',
			'is_natural' => 'El campo \'Codigo\' solo debe contener dígitos.',
			'exact_length' => 'El campo \'Codigo\' debe tener exactamente 10 caracteres de longitud.',
			'is_unique' => 'El Codigo \'{value}\' ya está en uso.'
		],
		'nombre' => [
			'required' => 'El campo \'Nombre\' es obligatorio.',
			'alpha_numeric_space' => 'El campo \'Nombre\' solo puede contener caracteres alfanuméricos y espacios.',
			'min_length' => 'El campo \'Nombre\' debe tener al menos 3 caracteres de longitud.',
			'max_length' => 'El campo \'Nombre\' no puede exceder los 40 caracteres de longitud.',
			'is_unique' => 'El Nombre \'{value}\' ya está en uso.'			
		],
		'id_unidad' => [
			'required' => 'Debe seleccionar una unidad',
			'is_natural_no_zero' => 'El campo \'Unidad\' solo debe contener dígitos y debe ser mayor que cero.',
		],
		'id_categoria' => [
			'required' => 'Debe seleccionar una categoria',
			'is_natural_no_zero' => 'El campo \'Categoria\' solo debe contener dígitos y debe ser mayor que cero.',
		],
		'precio_venta' => [
			'required' => 'El campo \'Precio de venta\' es obligatorio.',
			'regex_match' => 'El campo \'Precio de venta\' debe contener máximo 10 digitos y máximo 2 decimales, utilice el punto (.) para indicar decimales'
		],
		'precio_compra' => [
			'required' => 'El campo \'Precio de compra\' es obligatorio.',
			'regex_match' => 'El campo \'Precio de compra\' debe contener máximo 10 digitos y máximo 2 decimales, utilice el punto (.) para indicar decimales'
		],
		'stock_minimo' => [
			'required' => 'El campo \'Stock mínimo\' es obligatorio.',
			'is_natural_no_zero' => 'El campo \'Stock mínimo\' solo debe contener dígitos y debe ser mayor que cero.'
		],
		'inventariable' => [
			'required' => 'Debe indicar si el producto es inventariable',
			'is_natural' => 'El campo \'Es inventariable\' solo debe contener dígitos.'
		],
	];

	public $categorias_errors = [
        'nombre' => [
            'required' => 'El campo \'Nombre\' es obligatorio.',
			'alpha_numeric_space' => 'El campo \'Nombre\' solo puede contener caracteres alfanuméricos y espacios.',
			'min_length' => 'El campo \'Nombre\' debe tener al menos 3 caracteres de longitud.',
			'max_length' => 'El campo \'Nombre\' no puede exceder los 30 caracteres de longitud.',
			'is_unique' => 'El nombre \'{value}\' ya está en uso.'
		]
    ];

	public $clientes_errors = [
        'nombre' => [
            'required' => 'El campo \'Nombre\' es obligatorio.',
			'alpha_space' => 'El campo \'Nombre\' solo puede contener caracteres alfabéticos y espacios.',
			'min_length' => 'El campo \'Nombre\' debe tener al menos 3 caracteres de longitud.',
			'max_length' => 'El campo \'Nombre\' no puede exceder los 40 caracteres de longitud.'
		],
		'direccion' => [
			'alpha_numeric_punct' => 'El campo \'Dirección\' solo puede contener caracteres alfabéticos, espacios, numerales, guiones medios y bajos.',
			'min_length' => 'El campo \'Dirección\' debe tener al menos 3 caracteres de longitud.',
			'max_length' => 'El campo \'Dirección\' no puede exceder los 40 caracteres de longitud.'
		],
		'telefono' => [
			'is_natural' => 'El campo \'Telefono\' solo debe contener dígitos.',
			'exact_length' => 'El campo \'Telefono\' debe tener exactamente 10 caracteres de longitud.',
			'is_unique' => 'El telefono \'{value}\' ya está asociado a un cliente.'
		],
		'correo' => [
			'required' => 'El campo \'Correo\' es obligatorio.',
			'valid_email' => 'La dirección de correo electrónico es inválida.',
			'is_unique' => 'El correo \'{value}\' ya está en uso.'
		],
    ];

	public $configuracion_errors = [
        'nombre' => [
            'required' => 'El campo \'Nombre\' es obligatorio.',
			'alpha_numeric_space' => 'El campo \'Nombre\' solo puede contener caracteres alfanuméricos y espacios.',
			'min_length' => 'El campo \'Nombre\' debe tener al menos 3 caracteres de longitud.',
			'max_length' => 'El campo \'Nombre\' no puede exceder los 40 caracteres de longitud.'
		],
		'rfc' => [
            'required' => 'El campo \'rfc\' es obligatorio.',
			'alpha_numeric' => 'El campo \'rfc\' solo puede contener caracteres alfabéticos y espacios.',
			'exact_length' => 'El campo \'rfc\' debe tener exactamente 10 caracteres de longitud.',
		],
		'direccion' => [
			'alpha_numeric_punct' => 'El campo \'Dirección\' solo puede contener caracteres alfabéticos, espacios, numerales, guiones medios y bajos.',
			'min_length' => 'El campo \'Dirección\' debe tener al menos 3 caracteres de longitud.',
			'max_length' => 'El campo \'Dirección\' no puede exceder los 40 caracteres de longitud.'
		],
		'telefono' => [
			'required' => 'El campo \'Teléfono\' es obligatorio.',
			'is_natural' => 'El campo \'Telefono\' solo debe contener dígitos.',
			'exact_length' => 'El campo \'Telefono\' debe tener exactamente 10 caracteres de longitud.'
		],
		'correo' => [
			'required' => 'El campo \'Correo\' es obligatorio.',
			'valid_email' => 'La dirección de correo electrónico es inválida.'
		],
		'logo' => [
			'uploaded' => 'Debe seleccionar una imagen para el logotipo',
			'max_size' => 'La imagen del logotipo debe tener máximo 1MB de tamaño',
			'ext_in' => 'La extensión de la imagen debe ser .png'
		]
    ];

	public $usuarios_errors = [
		'nombre' => [
			'required' => 'El campo \'Nombre\' es obligatorio.',
			'alpha_space' => 'El campo \'Nombre\' solo puede contener caracteres alfanuméricos y espacios.',
			'min_length' => 'El campo \'Nombre\' debe tener al menos 3 caracteres de longitud.',
			'max_length' => 'El campo \'Nombre\' no puede exceder los 40 caracteres de longitud.'
		],
		'usuario' => [
			'required' => 'El campo \'Nombre de usuario\' es obligatorio.',
			'alpha_numeric_space' => 'El campo \'Usuario\' solo puede contener caracteres alfanuméricos y espacios.',
			'min_length' => 'El campo \'Usuario\' debe tener al menos 3 caracteres de longitud.',
			'max_length' => 'El campo \'Usuario\' no puede exceder los 40 caracteres de longitud.',
			'is_unique' => 'El nombre de usuario \'{value}\' ya está en uso.'
		],
		'id_rol' => [
			'required' => 'Debe seleccionar un rol',
			'is_natural_no_zero' => 'El campo \'Rol\' solo debe contener dígitos y debe ser mayor que cero.',
		],
		'id_caja' => [
			'required' => 'Debe seleccionar una caja',
			'is_natural_no_zero' => 'El campo \'Caja\' solo debe contener dígitos y debe ser mayor que cero.',
		],
		'clave' => [
			'required' => 'El campo \'Contraseña\' es obligatorio.',
			'min_length' => 'El campo \'Contraseña\' debe tener al menos 5 caracteres de longitud.',
			'max_length' => 'El campo \'Contraseña\' no puede exceder los 40 caracteres de longitud.'
		],
		'clave_confirmacion' => [
			'required' => 'El campo \'Confirmación\' es obligatorio.',
			'matches' => 'Las contraseñas no coinciden.',
			'min_length' => 'El campo \'Confirmación\' debe tener al menos 5 caracteres de longitud.',
			'max_length' => 'El campo \'Confirmación\' no puede exceder los 40 caracteres de longitud.'
		],
	];

	public $usuarios_editar_errors = [
		'nombre' => [
			'required' => 'El campo \'Nombre\' es obligatorio.',
			'alpha_space' => 'El campo \'Nombre\' solo puede contener caracteres alfanuméricos y espacios.',
			'min_length' => 'El campo \'Nombre\' debe tener al menos 3 caracteres de longitud.',
			'max_length' => 'El campo \'Nombre\' no puede exceder los 40 caracteres de longitud.'
		],
		'usuario' => [
			'required' => 'El campo \'Nombre de usuario\' es obligatorio.',
			'alpha_numeric_space' => 'El campo \'Usuario\' solo puede contener caracteres alfanuméricos y espacios.',
			'min_length' => 'El campo \'Usuario\' debe tener al menos 3 caracteres de longitud.',
			'max_length' => 'El campo \'Usuario\' no puede exceder los 40 caracteres de longitud.',
			'is_unique' => 'El nombre de usuario \'{value}\' ya está en uso.'
		],
		'id_rol' => [
			'required' => 'Debe seleccionar un rol',
			'is_natural_no_zero' => 'El campo \'Rol\' solo debe contener dígitos y debe ser mayor que cero.',
		],
		'id_caja' => [
			'required' => 'Debe seleccionar una caja',
			'is_natural_no_zero' => 'El campo \'Caja\' solo debe contener dígitos y debe ser mayor que cero.',
		],
	];

	public $roles_errors = [
        'nombre' => [
            'required' => 'El campo \'Rol\' es obligatorio.',
			'alpha' => 'El campo \'Rol\' solo puede contener caracteres alfabéticos.',
			'min_length' => 'El campo \'Rol\' debe tener al menos 3 caracteres de longitud.',
			'max_length' => 'El campo \'Rol\' no puede exceder los 30 caracteres de longitud.',
			'is_unique' => 'El nombre de rol \'{value}\' ya está en uso.'
		]
    ];

	public $cajas_errors = [
		'numero' => [
			'required' => 'El campo \'Número\' es obligatorio.',
			'is_natural' => 'El campo \'Número\' solo debe contener dígitos.',
			'exact_length' => 'El campo \'Número\' debe tener exactamente 3 caracteres de longitud.',
			'is_unique' => 'El Número \'{value}\' ya está en uso.'
		],
		'nombre' => [
			'required' => 'El campo \'Nombre\' es obligatorio.',
			'alpha_numeric_space' => 'El campo \'Nombre\' solo puede contener caracteres alfanuméricos y espacios.',
			'min_length' => 'El campo \'Nombre\' debe tener al menos 3 caracteres de longitud.',
			'max_length' => 'El campo \'Nombre\' no puede exceder los 10 caracteres de longitud.',
			'is_unique' => 'El Nombre \'{value}\' ya está en uso.'
		],
		'folio' => [
			'required' => 'El campo \'Folio\' es obligatorio.',
			'is_natural' => 'El campo \'Folio\' solo debe contener dígitos.',
			'exact_length' => 'El campo \'Folio\' debe tener exactamente 3 caracteres de longitud.',
			'is_unique' => 'El Folio \'{value}\' ya está en uso.'
		],
	];

	public $login_errors = [
		'usuario' => [
			'required' => 'El campo \'Usuario\' es obligatorio.',
			'alpha_numeric_space' => 'El campo \'Usuario\' solo puede contener caracteres alfanuméricos y espacios.',
			'min_length' => 'El campo \'Usuario\' debe tener al menos 3 caracteres de longitud.',
			'max_length' => 'El campo \'Usuario\' no puede exceder los 40 caracteres de longitud.'
		],
		'clave' => [
			'required' => 'El campo \'Contraseña\' es obligatorio.'
		]
	];

	public $contrasenha_errors = [
		'clave_actual' => [
			'required' => 'El campo \'Contraseña actual\' es obligatorio.'
		],
		'clave_nueva' => [
			'required' => 'El campo \'Nueva contraseña\' es obligatorio.',
			'min_length' => 'El campo \'Nueva contraseña\' debe tener al menos 5 caracteres de longitud.',
			'max_length' => 'El campo \'Nueva contraseña\' no puede exceder los 40 caracteres de longitud.'
		],
		'clave_confirmacion' => [
			'required' => 'El campo \'Confirmación\' es obligatorio.',
			'matches' => 'La nueva contraseña no coincide con la confirmación.',
			'min_length' => 'El campo \'Confirmación\' debe tener al menos 5 caracteres de longitud.',
			'max_length' => 'El campo \'Confirmación\' no puede exceder los 40 caracteres de longitud.'
		],
	];

	public $metodos_pagos_errors = [
        'nombre' => [
            'required' => 'El campo \'Nombre\' es obligatorio.',
			'alpha_numeric_space' => 'El campo \'Nombre\' solo puede contener caracteres alfanuméricos y espacios.',
			'min_length' => 'El campo \'Nombre\' debe tener al menos 3 caracteres de longitud.',
			'max_length' => 'El campo \'Nombre\' no puede exceder los 30 caracteres de longitud.',
			'is_unique' => 'El nombre \'{value}\' ya está en uso.'
		]
    ];
	
}
