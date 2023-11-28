#!/bin/bash
      # Copy .env.example to .env if it doesn't exist
      if [ ! -f /var/app/staging/.env ]; then
        cp /var/app/staging/.env.example /var/app/staging/.env
        echo ".env file created from .env.example"
      fi