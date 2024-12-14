"use strict";

// Class definition
var KTAuthI18nDemo = function() {
    // Elements
    var menu;

	var menuObj;

	var translationStrings = {
		// General
		"general-progress" : {
			"en" : "Please wait...",
			"es" : "Iniciar Sesión",
			"de" : "Registrarse",
			"ja" : "ログイン",
			"fr" : "S'identifier",
            'pt-BR' : 'Por favor, espere...',
		},
		"general-desc" : {
			"en" : "Get unlimited access & earn money",
			"es" : "Obtenga acceso ilimitado y gane dinero",
			"de" : "Erhalten Sie unbegrenzten Zugriff und verdienen Sie Geld",
			"ja" : "無制限のアクセスを取得してお金を稼ぐ",
			"fr" : "Obtenez un accès illimité et gagnez de l'argent",
            'pt-BR' : 'Obtenha acesso ilimitado e ganhe dinheiro',
		},

		"general-or" : {
			"en" : "Or",
			"es" : "O",
			"de" : "Oder",
			"ja" : "または",
			"fr" : "Ou",
            'pt-BR' : 'Ou',
        },

		// Sign in
		"sign-in-head-desc" : {
			"en" : "Not a Member yet?",
			"es" : "¿No eres miembro todavía?",
			"de" : "Noch kein Mitglied?",
			"ja" : "まだメンバーではありませんか？",
			"fr" : "Pas encore membre?",
            'pt-BR' : 'Ainda não é um membro?',
        },

		"sign-in-head-link" : {
			"en" : "Sign Up",
			"es" : "Inscribirse",
			"de" : "Anmeldung",
			"ja" : "サインアップ",
			"fr" : "S'S'inscrire",
            'pt-BR' : 'Inscrever-se',
        },

		"sign-in-title" : {
			"en" : "Sign In",
			"es" : "Iniciar Sesión",
			"de" : "Registrarse",
			"ja" : "ログイン",
			"fr" : "S'identifier",
            'pt-BR' : 'Entrar',
        },

		"sign-in-input-email" : {
			"en" : "Email",
			"es" : "Correo electrónico",
			"de" : "Email",
			"ja" : "Eメール",
			"fr" : "E-mail",
            'pt-BR' : 'Email',
        },

		"sign-in-input-password" : {
			"en" : "Password",
			"es" : "Clave",
			"de" : "Passwort",
			"ja" : "パスワード",
			"fr" : "Mot de passe",
            'pt-BR' : 'Senha',
        },

		"sign-in-forgot-password" : {
			"en" : "Forgot Password ?",
			"es" : "Has olvidado tu contraseña ?",
			"de" : "Passwort vergessen ?",
			"ja" : "パスワードをお忘れですか ？",
			"fr" : "Mot de passe oublié ?",
            'pt-BR' : 'Esqueceu a senha?',
        },

		"sign-in-submit" : {
			"en" : "Sign In",
			"es" : "Iniciar Sesión",
			"de" : "Registrarse",
			"ja" : "ログイン",
			"fr" : "S'identifier",
            'pt-BR' : 'Entrar',
        },

		// Sing up
		"sign-up-head-desc" : {
			"en" : "Already a member ?",
			"es" : "Ya eres usuario ?",
			"de" : "Schon ein Mitglied ?",
			"ja" : "すでにメンバーですか？",
			"fr" : "Déjà membre ?",
            'pt-BR' : 'Já é membro?',
        },

		"sign-up-head-link" : {
			"en" : "Sign In",
			"es" : "Iniciar Sesión",
			"de" : "Registrarse",
			"ja" : "ログイン",
			"fr" : "S'identifier",
            'pt-BR' : 'Entrar',
        },

		"sign-up-title" : {
			"en" : "Sign Up",
			"es" : "Inscribirse",
			"de" : "Anmeldung",
			"ja" : "サインアップ",
			"fr" : "S'S'inscrire",
            'pt-BR' : 'Inscrever-se',
        },

		"sign-up-input-first-name" : {
			"en" : "First Name",
			"es" : "Primer nombre",
			"de" : "Vorname",
			"ja" : "ファーストネーム",
			"fr" : "Prénom",
            'pt-BR' : 'Nome',
        },

		"sign-up-input-last-name" : {
			"en" : "Last Name",
			"es" : "Apellido",
			"de" : "Nachname",
			"ja" : "苗字",
			"fr" : "Nom de famille",
            'pt-BR' : 'Sobrenome',
        },

		"sign-up-input-email" : {
			"en" : "Email",
			"es" : "Correo electrónico",
			"de" : "Email",
			"ja" : "Eメール",
			"fr" : "E-mail",
            'pt-BR' : 'Email',
        },

		"sign-up-input-password" : {
			"en" : "Password",
			"es" : "Clave",
			"de" : "Passwort",
			"ja" : "パスワード",
			"fr" : "Mot de passe",
            'pt-BR' : 'Senha',
        },

		"sign-up-input-confirm-password" : {
			"en" : "Password",
			"es" : "Clave",
			"de" : "Passwort",
			"ja" : "パスワード",
			"fr" : "Mot de passe",
            'pt-BR' : 'Confirmar Senha',
        },

		"sign-up-submit" : {
			"en" : "Submit",
			"es" : "Iniciar Sesión",
			"de" : "Registrarse",
			"ja" : "ログイン",
			"fr" : "S'identifier",
            'pt-BR' : 'Enviar',
        },

		"sign-up-hint" : {
			"en" : "Use 8 or more characters with a mix of letters, numbers & symbols.",
			"es" : "Utilice 8 o más caracteres con una combinación de letras, números y símbolos.",
			"de" : "Verwenden Sie 8 oder mehr Zeichen mit einer Mischung aus Buchstaben, Zahlen und Symbolen.",
			"ja" : "文字、数字、記号を組み合わせた8文字以上を使用してください。",
			"fr" : "Utilisez 8 caractères ou plus avec un mélange de lettres, de chiffres et de symboles.",
            'pt-BR' : 'Use 8 ou mais caracteres com uma combinação de letras, números e símbolos.',
        },

		// New password
		"new-password-head-desc" : {
			"en" : "Already a member ?",
			"es" : "Ya eres usuario ?",
			"de" : "Schon ein Mitglied ?",
			"ja" : "すでにメンバーですか？",
			"fr" : "Déjà membre ?",
            'pt-BR' : 'Já é membro?',
        },

		"new-password-head-link" : {
			"en" : "Sign In",
			"es" : "Iniciar Sesión",
			"de" : "Registrarse",
			"ja" : "ログイン",
			"fr" : "S'identifier",
            'pt-BR' : 'Entrar',
        },

		"new-password-title" : {
			"en" : "Setup New Password",
			"es" : "Configurar nueva contraseña",
			"de" : "Neues Passwort einrichten",
			"ja" : "新しいパスワードを設定する",
			"fr" : "Configurer un nouveau mot de passe",
            'pt-BR' : 'Configurar nova senha',
        },

		"new-password-desc" : {
			"en" : "Have you already reset the password ?",
			"es" : "¿Ya has restablecido la contraseña?",
			"de" : "Hast du das Passwort schon zurückgesetzt?",
			"ja" : "すでにパスワードをリセットしましたか？",
			"fr" : "Avez-vous déjà réinitialisé le mot de passe ?",
            'pt-BR' : 'Já redefiniu sua senha?',
        },

		"new-password-input-password" : {
			"en" : "Password",
			"es" : "Clave",
			"de" : "Passwort",
			"ja" : "パスワード",
			"fr" : "Mot de passe",
            'pt-BR' : 'Senha',
        },

		"new-password-hint" : {
			"en" : "Use 8 or more characters with a mix of letters, numbers & symbols.",
			"es" : "Utilice 8 o más caracteres con una combinación de letras, números y símbolos.",
			"de" : "Verwenden Sie 8 oder mehr Zeichen mit einer Mischung aus Buchstaben, Zahlen und Symbolen.",
			"ja" : "文字、数字、記号を組み合わせた8文字以上を使用してください。",
			"fr" : "Utilisez 8 caractères ou plus avec un mélange de lettres, de chiffres et de symboles.",
            'pt-BR' : 'Use 8 ou mais caracteres com uma combinação de letras, números e símbolos.',
        },

		"new-password-confirm-password" : {
			"en" : "Confirm Password",
			"es" : "Confirmar contraseña",
			"de" : "Passwort bestätigen",
			"ja" : "パスワードを認証する",
			"fr" : "Confirmez le mot de passe",
            'pt-BR' : 'Confirmar Senha',
        },

		"new-password-submit" : {
			"en" : "Submit",
			"es" : "Iniciar Sesión",
			"de" : "Registrarse",
			"ja" : "ログイン",
			"fr" : "S'identifier",
            'pt-BR' : 'Enviar',
        },

		// Password reset
		"password-reset-head-desc" : {
			"en" : "Already a member ?",
			"es" : "Ya eres usuario ?",
			"de" : "Schon ein Mitglied ?",
			"ja" : "すでにメンバーですか？",
			"fr" : "Déjà membre ?",
            'pt-BR' : 'Já é membro?',
        },

		"password-reset-head-link" : {
			"en" : "Sign In",
			"es" : "Iniciar Sesión",
			"de" : "Registrarse",
			"ja" : "ログイン",
			"fr" : "S'identifier",
            'pt-BR' : 'Entrar',
        },

		"password-reset-title" : {
			"en" : "Forgot Password ?",
			"es" : "Has olvidado tu contraseña ?",
			"de" : "Passwort vergessen ?",
			"ja" : "パスワードをお忘れですか ？",
			"fr" : "Mot de passe oublié ?",
            'pt-BR' : 'Esqueceu a senha?',
        },

		"password-reset-desc" : {
			"en" : "Enter your email to reset your password.",
			"es" : "Ingrese su correo electrónico para restablecer su contraseña.",
			"de" : "Geben Sie Ihre E-Mail-Adresse ein, um Ihr Passwort zurückzusetzen.",
			"ja" : "メールアドレスを入力してパスワードをリセットしてください。",
			"fr" : "Entrez votre e-mail pour réinitialiser votre mot de passe.",
            'pt-BR' : 'Insira seu email para redefinir sua senha.',
        },

		"password-reset-input-email" : {
			"en" : "Email",
			"es" : "Correo electrónico",
			"de" : "Email",
			"ja" : "Eメール",
			"fr" : "E-mail",
            'pt-BR' : 'Email',
        },

		"password-reset-submit" : {
			"en" : "Submit",
			"es" : "Iniciar Sesión",
			"de" : "Registrarse",
			"ja" : "ログイン",
			"fr" : "S'identifier",
            'pt-BR' : 'Enviar',
        },

		"password-reset-cancel" : {
			"en" : "Cancel",
			"es" : "Cancelar",
			"de" : "Absagen",
			"ja" : "キャンセル",
			"fr" : "Annuler",
            'pt-BR' : 'Cancelar',
        },

		// Two steps
		"two-step-head-desc" : {
			"en" : "Didn’t get the code ?",
			"es" : "¿No recibiste el código?",
			"de" : "Code nicht erhalten?",
			"ja" : "コードを取得できませんでしたか？",
			"fr" : "Vous n'avez pas reçu le code ?",
            'pt-BR' : 'Não recebeu o código?',
        },

		"two-step-head-resend" : {
			"en" : "Resend",
			"es" : "Reenviar",
			"de" : "Erneut senden",
			"ja" : "再送",
			"fr" : "Renvoyer",
            'pt-BR' : 'Reenviar',
        },

		"two-step-head-or" : {
			"en" : "Or",
			"es" : "O",
			"de" : "Oder",
			"ja" : "または",
			"fr" : "Ou",
            'pt-BR' : 'Ou',
        },

		"two-step-head-call-us" : {
			"en" : "Call Us",
			"es" : "Llámenos",
			"de" : "Rufen Sie uns an",
			"ja" : "お電話ください",
			"fr" : "Appelez-nous",
            'pt-BR' : 'Ligue para nós',
        },

		"two-step-submit" : {
			"en" : "Submit",
			"es" : "Iniciar Sesión",
			"de" : "Registrarse",
			"ja" : "ログイン",
			"fr" : "S'identifier",
            'pt-BR' : 'Enviar',
        },

		"two-step-title" : {
			"en" : "Two Step Verification",
			"es" : "Verificación de dos pasos",
			"de" : "Verifizierung in zwei Schritten",
			"ja" : "2段階認証",
			"fr" : "Vérification en deux étapes",
            'pt-BR' : 'Verificação em duas etapas',
        },

		"two-step-deck" : {
			"en" : "Enter the verification code we sent to",
			"es" : "Ingresa el código de verificación que enviamos a",
			"de" : "Geben Sie den von uns gesendeten Bestätigungscode ein",
			"ja" : "送信した確認コードを入力してください",
			"fr" : "Entrez le code de vérification que nous avons envoyé à",
            'pt-BR' : 'Insira o código de verificação que enviamos para',
        },

		"two-step-label" : {
			"en" : "Type your 6 digit security code",
			"es" : "Escriba su código de seguridad de 6 dígitos",
			"de" : "Geben Sie Ihren 6-stelligen Sicherheitscode ein",
			"ja" : "6桁のセキュリティコードを入力します",
			"fr" : "Tapez votre code de sécurité à 6 chiffres",
            'pt-BR' : 'Digite seu código de segurança de 6 dígitos',
        }
	}

    // Handle form
    var translate = function(langCode) {
        for (var label in translationStrings) {
            if (translationStrings.hasOwnProperty(label)) {
                if (translationStrings[label][langCode]) {
                    let labelElement = document.querySelector('[data-kt-translate=' + label + ']');
                    if (labelElement !== null) {
                        if (labelElement.tagName === "INPUT") {
                            labelElement.setAttribute("placeholder", translationStrings[label][langCode]);
                        } else {
                            labelElement.innerHTML = translationStrings[label][langCode];
                        }
                    }
                }
            }
        }
    }

    var setLanguage = function(langCode) {
        const selectedLang = menu.querySelector('[data-kt-lang="' + langCode + '"]');
        if (selectedLang !== null) {
            const currentLangName = document.querySelector('[data-kt-element="current-lang-name"]');
            const currentLangFlag = document.querySelector('[data-kt-element="current-lang-flag"]');

            const selectedLangName = selectedLang.querySelector('[data-kt-element="lang-name"]');
            const selectedLangFlag = selectedLang.querySelector('[data-kt-element="lang-flag"]');

            currentLangName.innerText = selectedLangName.innerText;
            currentLangFlag.setAttribute("src", selectedLangFlag.getAttribute("src"));

            localStorage.setItem("kt_auth_lang", langCode);
        }
    };

    var init = function() {
		if ( localStorage.getItem("kt_auth_lang") !== null ) {
			let lang = localStorage.getItem("kt_auth_lang");

			setLanguage(lang);
			translate(lang);
		}

		menuObj.on("kt.menu.link.click", function(element) {
			let lang = element.getAttribute("data-kt-lang");

			setLanguage(lang);
			translate(lang);
		});
	}

    // Public functions
    return {
        // Initialization
        init: function() {
            menu = document.querySelector('#kt_auth_lang_menu');

			if (menu === null) {
				return;
			}

			menuObj = KTMenu.getInstance(menu);

            init();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTAuthI18nDemo.init();
});
