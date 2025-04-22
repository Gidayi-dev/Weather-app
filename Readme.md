# Weather App

## Overview
This Weather App allows users to check the current weather and a 3-day forecast for any city worldwide. It uses the OpenWeatherMap API to fetch weather data and is built with a modern tech stack:
- **Frontend**: Next.js with TypeScript, styled using Tailwind CSS and RippleUI.
- **Backend**: Laravel (PHP) to handle API requests and interact with OpenWeatherMap.

### Features
- Search for weather by city name.
- Toggle between Celsius and Fahrenheit units.
- Displays current weather: temperature, description, date, and city name.
- Shows a 3-day forecast with temperature and weather conditions.
- Includes wind speed and humidity with a progress bar for humidity.
- Responsive design with a clean UI using Tailwind CSS and RippleUI.

## Prerequisites
Before running the app, ensure you have the following installed:
- **Node.js** (v16 or higher) and npm (for the frontend)
- **PHP** (v8.1 or higher) and Composer (for the backend)
- **SQLite** (or another database supported by Laravel; SQLite is used by default in this project)
- A valid **OpenWeatherMap API key** (free tier):
  1. Sign up at [openweathermap.org](https://openweathermap.org/).
  2. Go to the "API keys" tab in your account dashboard.
  3. Copy your API key (a 32-character hexadecimal string, e.g., `5f4c3d2e1b0a987654321fedcba98765`).

## Project Structure
- `weather-frontend/`: Next.js frontend with TypeScript, Tailwind CSS, and RippleUI.
- `weather-backend/`: Laravel backend to handle API requests to OpenWeatherMap.

## Setup and Installation

### 1. Clone the Repository
Clone the repository to your local machine:
```bash
git clone https://github.com/Gidayi-dev/Weather-app
cd Weather-app