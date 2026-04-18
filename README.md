<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 🎫 Ingressou

Um sistema completo de gestão de eventos e bilheteria digital focado na melhor experiência do usuário, construído com alta performance, design limpo e interfaces premium corporativas.

## Tecnologias e Arquitetura

O **Ingressou** foi arquitetado separando claramente as responsabilidades de backend e frontend dentro do ecossistema moderno do Laravel, permitindo escalabilidade e robustez.

### Backend Integrado (Monolito Moderno)
- **Framework:** [Laravel 13](https://laravel.com/)
- **Linguagem:** PHP 8.5
- **Banco de Dados:** MySQL (via Eloquent ORM)
- **Geração de Ingressos:** [Simple QrCode](https://www.simplesoftware.io/docs/simple-qrcode) para compilação instantânea e segura de chaves únicas por participante.

### Frontend UI/UX Premium
- **Estilização:** [Tailwind CSS](https://tailwindcss.com/)
- **Templates:** Laravel Blade Components com estado modular.
- **Design System:** Design minimalista, focado em alta legibilidade. Paleta construída no espectro '*Neutral*' (tons de chumbo, chumbo-escuro e off-whites) abstraindo totalmente cores brilhantes para entregar um aspecto totalmente profissional e de imersão corporativa.
- **Validação na Portaria Frontend:** Scanner de QR Code nativo usando a biblioteca [html5-qrcode](https://github.com/mebjas/html5-qrcode), otimizada para captar leituras tanto por câmeras de celular quanto por webcams no check-in no formato tempo real.

---

## ⚙️ Principais Funcionalidades

1. **Vitrine e Calendário de Eventos:** Catálogo aberto para eventos em formato card de alta classe sem distrações visuais.
2. **Sistema de Contas:** Perfis de usuário otimizados para rápida inscrição.
3. **Emissão de Ingressos em PDF/Web:** Cada inscrição possui geração de página blindada de ingresso e print local contendo um Hash/QR Único.
4. **Dashboard Administrativo:** Controle de dados, listagem de eventos e inscrições em tempo real.
5. **Scanner de Portaria:** Validação física e aprovação de entrada via câmera/QR.

---

## 🛠️ Como Instalar e Rodar o Projeto

Siga as etapas abaixo para providenciar o ambiente de desenvolvimento local.

### Pré-requisitos
- **PHP** >= 8.2 (Recomendado 8.5 conforme stack)
- **Composer** instalado globalmente
- **Node.js** & **NPM**
- **MySQL** ou MariaDB rodando localmente (ex: XAMPP, Laragon ou Docker).

### Passo a Passo

**1. Clone o repositório**
```bash
git clone https://github.com/seu-usuario/ingressou.git
cd ingressou
```

**2. Instale as dependências do PHP (Backend)**
```bash
composer install
```

**3. Instale as dependências do Javascript/CSS (Frontend)**
```bash
npm install
```

**4. Configuração do Arquivo de Ambiente**
Crie uma cópia do arquivo de configuração padrão:
```bash
cp .env.example .env
```
Abra o arquivo `.env` gerado e configure a conexão com seu banco de dados local:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ingressou
DB_USERNAME=root
DB_PASSWORD=
```

**5. Geração e Preparação Estrutural**
Gere a chave da aplicação e crie o link simbólico para os arquivos físicos (como imagens e banners de eventos):
```bash
php artisan key:generate
php artisan storage:link
```

**6. Banco de Dados e Migrations**
Popule as tabelas da base com o comando de migrate, e aproveite as Seeds para possivelmente gerar o usuário Administrador padrão:
```bash
php artisan migrate --seed
```
*(Nota: Se houver uma seed de administrador, utilize o e-mail cadastrado por ela para fazer login e ver a visão de Scanner e Eventos).*

**7. Iniciando os Servidores**
Será necessário ter dois terminais abertos. No primeiro, rode o compilador do Tailwind:
```bash
npm run dev
```

E no segundo terminal conectado a sua pasta, rode o serviço PHP:
```bash
php artisan serve
```

---

## Acesso à Aplicação
A aplicação subirá em seu localhost! Simplesmente acesse pelo navegador:

**Web:** [http://127.0.0.1:8000](http://127.0.0.1:8000)

Sinta-se à vontade para colaborar criando forks, ou abri issues em caso de melhorias!
