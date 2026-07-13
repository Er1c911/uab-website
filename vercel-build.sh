#!/bin/bash
set -e

echo "Building UAB Website..."

# Install Node dependencies
npm install

# Build Vite assets
npm run build

# Setup storage directory if needed
mkdir -p storage/app storage/framework storage/logs

echo "Build completed successfully!"
