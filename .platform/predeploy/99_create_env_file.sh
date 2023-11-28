#!/bin/bash
      # Copy .env.example to .env if it doesn't exist
      if [ ! -f /var/app/current/.env ]; then
        cp /var/app/current/.env.example /var/app/current/.env
        echo ".env file created from .env.example"
      fi